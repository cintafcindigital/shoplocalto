<?php
namespace App\Http\Controllers\payment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Vendor;
use App\PaymentMethod;
use App\Subscription;
use App\VendorCompany;
use App\VendorInvoice;
use App\VendorBill;
use App\VendorImage;
use App\TrackPayment;
use App\FeaturedProfile;
use App\VendorFeaturedProfile;
use App\Mail\VendorAfterPayment;
use App\Mail\PaymentFailedVendor;
use App\Mail\WelcomeMailToVendor;
use App\Mail\ProfessionalTipsMail;
use App\Mail\ProfessionalTipsLeadMail;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;
use Auth;
use Session;

class PayPalPaymentController extends Controller
{
    public $api_context = '';
    public function __construct()
    {
        $this->api_context = new ApiContext(
            new OAuthTokenCredential(config('paypal.client_id'), config('paypal.secret'))
        );
        $this->api_context->setConfig(config('paypal.settings'));
    }
    public function request_payment(Request $request)
    {
        $vendor_id = Session::get('session_vendorId');
        $trackPayment = new TrackPayment;
        $pay_amount = $request->amount_to_pay;
        $trackPayment->vendor_id = $vendor_id;
        $trackPayment->amount = $pay_amount;
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item = new Item();
        $item->setName('Paypal Payment')->setCurrency('CAD')->setQuantity(1)->setPrice($pay_amount);
        $itemList = new ItemList();
        $itemList->setItems(array($item));
        $amount = new Amount();
        $amount->setCurrency('CAD')->setTotal($pay_amount);
        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($itemList)
            ->setDescription('My Health Squad Professional Registartion Payment.');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('confirm-payment',encrypt($request->subscription_id)))
        ->setCancelUrl(url()->current());
        $payment = new Payment();
        $payment->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)
        ->setTransactions(array($transaction));
        try {
            $payment->create($this->api_context);
        } catch (PayPalConnectionException $ex){
            // print_r($ex->getMessage());
            $trackPayment->error = $ex->getMessage();
            $trackPayment->save();
            return redirect()->back()->with('error','Payment was not successful ');
            die;
            // return back()->withError('Some error occur, sorry for inconvenient');
        } catch (Exception $ex) {
            // print_r($ex->getMessage());
            $trackPayment->error = $ex->getMessage();
            $trackPayment->save();
            return redirect()->back()->with('error','Payment was not successful ');
            die;
            // return back()->withError('Some error occur, sorry for inconvenient');
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        if(isset($redirect_url)) {
            $trackPayment->save();
            return redirect($redirect_url);
        }
        $trackPayment->error = 'Payment was not successful';
        $trackPayment->save();
        return redirect()->back()->with('error','Payment was not successful ');
    }
    public function payment_status($subscription_id,Request $request)
    {
        $subscription_id = decrypt($subscription_id);
        $trackPayment = new TrackPayment;
        $vendor_id = Session::get('session_vendorId');
        $vendorObj = Vendor::find($vendor_id);
        $vendors = $vendorObj;
        $trackPayment->vendor_id = $vendor_id;
        $trackPayment->type = 'STATUS';
        if (empty($request->query('paymentId')) || empty($request->query('PayerID')) || empty($request->query('token'))){
            $trackPayment->error = 'Not get any query string like paymentId, PayerID or token from paypal in request.';
            $trackPayment->save();
            try {
                Mail::to($vendors->email)->send(new PaymentFailedVendor($username));
            } catch (\Exception $e) {}
            return redirect('payment-packages')->with('error','Payment was not successful ');
        }
        $trackPayment->payment_id = $request->query('paymentId');
        $trackPayment->payer_id = $request->query('PayerID');
        $trackPayment->paypal_token = $request->query('token');
        $payment = Payment::get($request->query('paymentId'), $this->api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->query('PayerID'));
        $result = $payment->execute($execution, $this->api_context);
        if ($result->getState() != 'approved'){
            $trackPayment->error = 'state not approved from paypal.';
            $trackPayment->save();
            try {
                Mail::to($vendors->email)->send(new PaymentFailedVendor($username));
            } catch (\Exception $e) {}
            return redirect('payment-packages')->with('error','Payment was not successful ');
        }
        if($vendor_id == null || $vendor_id == '' || empty($vendor_id)){
            if(Auth::guard('vendor')->check())
                return redirect('dashboard');
            else
                return redirect('/');
        }
        $paymnt = new PaymentMethod();
        $paymnt->vendor_id       = $vendor_id;
        $paymnt->pay_type        = 'full';
        $paymnt->save();
        if($paymnt->id) {
            $subscription = Subscription::where('id',$subscription_id)->first();
            $due_date = date('Y-m-d');
            $numLoops = 0;
            if($subscription->duration == '3 Months') {
                $numLoops = 3;
                $due_date = date('Y-m-d', strtotime("+3 months", strtotime($due_date)));
            } elseif($subscription->duration == '6 Months') {
                $numLoops = 6;
                $due_date = date('Y-m-d', strtotime("+6 months", strtotime($due_date)));
            } elseif($subscription->duration == '1 Year') {
                $numLoops = 12;
                $due_date = date('Y-m-d', strtotime("+12 months", strtotime($due_date)));
            } elseif($subscription->duration == '1 Month') {
                $numLoops = 1;
                $due_date = date('Y-m-d', strtotime("+1 months", strtotime($due_date)));
            }
            $subsAmount = $subscription->amount;

            do{
                $receiptNumber = mt_rand(1000000000000,9999999999999);
            }while(VendorInvoice::where('receipt',$receiptNumber)->count() > 0);
            $vendorInvoice = new VendorInvoice;
            $vendorInvoice->invoice_id          = 'MHS'.str_pad((string) $vendorInvoice->id,7,'0',STR_PAD_LEFT);
            $vendorInvoice->reciept_id          = $receiptNumber;
            $vendorInvoice->vendor_id           = $vendor_id;
            $vendorInvoice->subscription_id     = $subscription_id;
            $vendorInvoice->subscription_date   = date('Y-m-d');
            $vendorInvoice->due_date            = $due_date;
            $vendorInvoice->subscription_amount = $subscription->amount;
            $vendorInvoice->status              = '1';
            $vendorInvoice->payment_method      = 'paypal';
            $vendorInvoice->save();
            $pay_type = 'full';
            if($vendorInvoice->id){
                $vendorInvoice->invoice_id          = 'MHS'.str_pad((string) $vendorInvoice->id,7,'0',STR_PAD_LEFT);
                $vendorInvoice->save();
                for($vbn = 0; $vbn < $numLoops; $vbn++) {
                    $vendorBill = new VendorBill;
                    $vendorBill->vendor_id       = $vendor_id;
                    $vendorBill->subscription_id = $subscription_id;
                    $vendorBill->invoice_id      = $vendorInvoice->id;
                    $vendorBill->invoice_number  = $vendorInvoice->invoice_id.(date('m',strtotime("+$vbn months",strtotime(date('Y-m-d')))));
                    $vendorBill->due_date        = date('Y-m-d', strtotime("+$vbn months", strtotime(date('Y-m-d'))));
                    $vendorBill->paid_amount     = round($subscription->amount / $numLoops, 2);
                    $vendorBill->paid_date       = date('Y-m-d');
                    $vendorBill->card_id         = $paymnt->id;
                    if($pay_type == 'monthly') {
                        if($vbn == 0) {
                            $vendorBill->status  = '1';
                        } else {
                            $vendorBill->status  = '0';
                        }
                    } elseif($pay_type == 'full') {
                        $vendorBill->status      = '1';
                    }
                    $vendorBill->save();
                }
            }
        }
        $vendorObj->freelisting = 'No';
        $vendorObj->pay_status = 1;
        $vendorObj->verified = 1;
        $vendorObj->save();
        $username = Session::get('_vendor_username');
        $password = Session::get('_vendor_password');
        Auth::guard('vendor')->attempt(['username' => $username,'password' => $password]);
        Session::forget('_vendor_registration_step');
        Session::forget('_vendor_id');
        Session::forget('_vendor_username');
        Session::forget('_vendor_password');
        Session::forget('session_vendorId');
        $vendorCompany = VendorCompany::where('vendor_id','!=',$vendor_id)->inRandomOrder()->limit(3)->get();
        try {
            Mail::to($vendors->email)->send(new WelcomeMailToVendor($username));
            Mail::to($vendors->email)->send(new VendorAfterPayment($vendors->username));
        } catch (\Exception $e) {}
        // Mail::to($vendors->email)->send(new ProfessionalTipsMail($vendors->username,'','',$vendorCompany,$vendors->email));
        // Mail::to($vendors->email)->send(new ProfessionalTipsLeadMail($vendors->username,'','',$vendors->email));
        $trackPayment->save();
        return redirect('dashboard')->with('success','Your payment was successfully registered !!');
    }
    public function vendorPaymentFromAdmin(Request $request)
    {
        // $this->middleware('auth:admin');
        $vendorId = $request->vendor_id;
        $vendorData = Vendor::where('vendor_id',$vendorId)->first();
        if($vendorId && isset($vendorData->vendor_id)) {
            $paymnt = new PaymentMethod();
            $paymnt->vendor_id       = $vendorId;
            $paymnt->pay_type        = $request->pay_type;
            $paymnt->save();
            if($paymnt->id) {
                $subscription = Subscription::where('id',$request->subscription_id)->first();
                $due_date = date('Y-m-d');
                $numLoops = 0;
                if($subscription->duration == '3 Months') {
                    $numLoops = 3;
                    $due_date = date('Y-m-d', strtotime("+3 months", strtotime($due_date)));
                } elseif($subscription->duration == '6 Months') {
                    $numLoops = 6;
                    $due_date = date('Y-m-d', strtotime("+6 months", strtotime($due_date)));
                } elseif($subscription->duration == '1 Year') {
                    $numLoops = 12;
                    $due_date = date('Y-m-d', strtotime("+12 months", strtotime($due_date)));
                } elseif($subscription->duration == '1 Month') {
                    $numLoops = 1;
                    $due_date = date('Y-m-d', strtotime("+1 months", strtotime($due_date)));
                }
                $subsAmount = $subscription->amount;
                if($request->pay_type == 'monthly')
                    $subsAmount = round($subscription->amount / $numLoops, 2);
                $trackPayment = new TrackPayment;
                $pay_amount = $subsAmount;
                $trackPayment->vendor_id = $vendorId;
                $trackPayment->amount = $pay_amount;
                $payer = new Payer();
                $payer->setPaymentMethod('paypal');
                $item = new Item();
                $item->setName('Paypal Payment')->setCurrency('CAD')->setQuantity(1)->setPrice($pay_amount);
                $itemList = new ItemList();
                $itemList->setItems(array($item));
                $amount = new Amount();
                $amount->setCurrency('CAD')->setTotal($pay_amount);
                $transaction = new Transaction();
                $transaction->setAmount($amount)->setItemList($itemList)
                    ->setDescription('My Health Squad Professional Vendor Payment Form Admin.');
                $redirect_urls = new RedirectUrls();
                $redirect_urls->setReturnUrl(url('admin/payment-vendor-status'.'/'.encrypt($vendorId).'/'.encrypt($subscription->id).'/'.encrypt($pay_amount).'/'.encrypt($due_date).'/'.encrypt($numLoops).'/'.encrypt($request->pay_type).'/'.encrypt($paymnt->id)))
                ->setCancelUrl(url('admin/freelisting-vendors'));
                $payment = new Payment();
                $payment->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
                try {
                    $payment->create($this->api_context);
                } catch (PayPalConnectionException $ex){
                    $trackPayment->error = $ex->getMessage();
                    $trackPayment->save();
                    return redirect()->back()->with('error','Payment was not successful ');
                    die;
                } catch (Exception $ex) {
                    $trackPayment->error = $ex->getMessage();
                    $trackPayment->save();
                    return redirect()->back()->with('error','Payment was not successful ');
                    die;
                }
                foreach($payment->getLinks() as $link) {
                    if($link->getRel() == 'approval_url') {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }
                if(isset($redirect_url)) {
                    $trackPayment->save();
                    return redirect($redirect_url);
                }
                $trackPayment->error = 'Payment was not successful';
                $trackPayment->save();
                return redirect()->back()->with('error','Payment was not successful ');
            } else
                return redirect()->back()->with('error','Payment not saved to database. So please try again later !!');
        } else
            return redirect()->back()->with('error','Your selected vendor is not found. So please try again later !!');
    }
    public function vendorPaymentFromAdminStatus($vendor_id,$subscription_id,$amount,$due_date,$numLoops,$pay_type,$paymnt_id,Request $request)
    {
        $this->middleware('auth:admin');
        $vendor_id = decrypt($vendor_id);
        $subscription_id = decrypt($subscription_id);
        $subscription = Subscription::where('id',$subscription_id)->first();
        $amount_old = $amount;
        $amount = decrypt($due_date);
        $due_date = decrypt($amount_old);
        $numLoops = decrypt($numLoops);
        $pay_type = decrypt($pay_type);
        $paymnt_id = decrypt($paymnt_id);
        // echo $vendor_id,'<br>',$subscription_id,'<br>',$amount,'<br>',$due_date,'<br>',$numLoops,'<br>',$pay_type,'<br>',$paymnt_id,'<br>';die;
        $trackPayment = new TrackPayment;
        $vendorObj = Vendor::where('vendor_id',$vendor_id)->first();
        $trackPayment->vendor_id = $vendor_id;
        $trackPayment->type = 'STATUS';
        if (empty($request->query('paymentId')) || empty($request->query('PayerID')) || empty($request->query('token'))){
            $trackPayment->error = 'Not get any query string like paymentId, PayerID or token from paypal in request.';
            $trackPayment->save();
            return redirect('admin/freelisting-vendors')->with('error','Payment was not successful.');
        }
        $trackPayment->payment_id = $request->query('paymentId');
        $trackPayment->payer_id = $request->query('PayerID');
        $trackPayment->paypal_token = $request->query('token');
        $payment = Payment::get($request->query('paymentId'), $this->api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->query('PayerID'));
        $result = $payment->execute($execution, $this->api_context);
        if ($result->getState() != 'approved'){
            $trackPayment->error = 'state not approved from paypal.';
            $trackPayment->save();
            return redirect('admin/freelisting-vendors')->with('error','Payment was not successful ');
        }
        if($vendor_id == null || $vendor_id == '' || empty($vendor_id) && !isset($vendorObj->id)){
            $trackPayment->error = 'Selected vendor not found !!';
            $trackPayment->save();
            return redirect('admin/freelisting-vendors')->with('error','Selected vendor not found.');
        }
        $vendorInvoice = new VendorInvoice;
        do{
            $receiptNumber = mt_rand(1000000000000,9999999999999);
        }while(VendorInvoice::where('receipt',$receiptNumber)->count() > 0);
        $vendorInvoice->invoice_id          = 'MHS'.str_pad((string) $vendorInvoice->id,7,'0',STR_PAD_LEFT);
        $vendorInvoice->reciept_id          = $receiptNumber;
        $vendorInvoice->vendor_id           = $vendor_id;
        $vendorInvoice->subscription_id     = $subscription_id;
        $vendorInvoice->subscription_date   = date('Y-m-d');
        $vendorInvoice->due_date            = $due_date;
        $vendorInvoice->subscription_amount = $amount;
        $vendorInvoice->status              = '1';
        $vendorInvoice->payment_method      = 'paypal';
        $vendorInvoice->save();
        if($vendorInvoice->id){
            $vendorInvoice->invoice_id          = 'MHS'.str_pad((string) $vendorInvoice->id,7,'0',STR_PAD_LEFT);
            $vendorInvoice->save();
            for($vbn = 0; $vbn < $numLoops; $vbn++) {
                $vendorBill = new VendorBill;
                $vendorBill->vendor_id       = $vendor_id;
                $vendorBill->subscription_id = $subscription_id;
                $vendorBill->invoice_id      = $vendorInvoice->id;
                $vendorBill->invoice_number  = $vendorInvoice->invoice_id.(date('m',strtotime("+$vbn months",strtotime(date('Y-m-d')))));
                $vendorBill->due_date        = date('Y-m-d', strtotime("+$vbn months", strtotime(date('Y-m-d'))));
                $vendorBill->paid_amount     = round($subscription->amount / $numLoops, 2);
                $vendorBill->paid_date       = date('Y-m-d');
                $vendorBill->card_id         = $paymnt_id;
                if($pay_type == 'monthly') {
                    if($vbn == 0) {
                        $vendorBill->status  = '1';
                    } else {
                        $vendorBill->status  = '0';
                    }
                } elseif($pay_type == 'full') {
                    $vendorBill->status      = '1';
                }
                $vendorBill->save();
            }
        }
        $trackPayment->save();
        $vendors = Vendor::find($vendor_id);
        $vendors->status = 1;
        $vendors->pay_status = 1;
        $vendors->freelisting = 'No';
        $vendors->save();
        return redirect('admin/freelisting-vendors')->with('success','Your payment was successfully registered !!');
    }
    public function featuredProfileRequest(Request $request)
    {
        $this->middleware('auth:vendor');
        $featured = FeaturedProfile::find($request->feature);
        $vendor_id = auth()->guard('vendor')->user()->vendor_id;
        $trackPayment = new TrackPayment;
        $pay_amount = $featured->amount;
        $trackPayment->vendor_id = $vendor_id;
        $trackPayment->amount = $pay_amount;
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item = new Item();
        $item->setName('Paypal Payment')->setCurrency('CAD')->setQuantity(1)->setPrice($pay_amount);
        $itemList = new ItemList();
        $itemList->setItems(array($item));
        $amount = new Amount();
        $amount->setCurrency('CAD')->setTotal($pay_amount);
        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($itemList)
            ->setDescription('My Health Squad Professional Registartion Payment.');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('featured.lists',encrypt($featured->id)))
                        ->setCancelUrl(url()->current());
        $payment = new Payment();
        $payment->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)
        ->setTransactions(array($transaction));
        try {
            $payment->create($this->api_context);
        } catch (PayPalConnectionException $ex){
            // print_r($ex->getMessage());
            $trackPayment->error = $ex->getMessage();
            $trackPayment->save();
            return redirect()->back()->with('error','Payment was not successful ');
            die;
            // return back()->withError('Some error occur, sorry for inconvenient');
        } catch (Exception $ex) {
            // print_r($ex->getMessage());
            $trackPayment->error = $ex->getMessage();
            $trackPayment->save();
            return redirect()->back()->with('error','Payment was not successful ');
            die;
            // return back()->withError('Some error occur, sorry for inconvenient');
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        if(isset($redirect_url)) {
            $trackPayment->save();
            return redirect($redirect_url);
        }
        $trackPayment->error = 'Payment was not successful';
        $trackPayment->save();
        return redirect()->back()->with('error','Payment was not successful ');
    }
    public function featuredProfilePaymentSuccess($featureId,Request $request)
    {
        $this->middleware('auth:vendor');
        $featureId = decrypt($featureId);
        $featured = FeaturedProfile::find($featureId);
        $trackPayment = new TrackPayment;
        $vendor_id = auth()->guard('vendor')->user()->vendor_id;
        $vendorObj = Vendor::find($vendor_id);
        $vendors = $vendorObj;
        $trackPayment->vendor_id = $vendor_id;
        $trackPayment->type = 'STATUS';
        if (empty($request->query('paymentId')) || empty($request->query('PayerID')) || empty($request->query('token'))){
            $trackPayment->error = 'Not get any query string like paymentId, PayerID or token from paypal in request.';
            $trackPayment->save();
            try {
                Mail::to($vendors->email)->send(new PaymentFailedVendor($username));
            } catch (\Exception $e) {}
            return redirect('featured')->with('error','Payment was not successful.If your amount is returned from your bank please create a support ticket from your account.');
        }
        $trackPayment->payment_id = $request->query('paymentId');
        $trackPayment->payer_id = $request->query('PayerID');
        $trackPayment->paypal_token = $request->query('token');
        $payment = Payment::get($request->query('paymentId'), $this->api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->query('PayerID'));
        $result = $payment->execute($execution, $this->api_context);
        if ($result->getState() != 'approved'){
            $trackPayment->error = 'state not approved from paypal.';
            $trackPayment->save();
            try {
                Mail::to($vendors->email)->send(new PaymentFailedVendor($username));
            } catch (\Exception $e) {}
            return redirect('featured')->with('error','Payment was not successful.If your amount is returned from your bank please create a support ticket from your account.');
        }

        $featuredProfile                        = new VendorFeaturedProfile;
        $featuredProfile->vendor_id             = $vendor_id;
        $featuredProfile->featured_profile_id   = $featureId->id;
        $featuredProfile->weeks                 = $featureId->weeks;
        $featuredProfile->amount                = $featureId->amount;
        $featuredProfile->start_date            = date('Y-m-d');
        $featuredProfile->days                  = (int) $featuredProfile->weeks*7;
        $featuredProfile->due_date              = date('Y-m-d', strtotime("+".$featuredProfile->days." days", strtotime(date('Y-m-d'))));
        $featuredProfile->save();


        do{
            $receiptNumber = mt_rand(1000000000000,9999999999999);
        }while(VendorInvoice::where('receipt',$receiptNumber)->count() > 0);

        $vendorInvoice                      = new VendorInvoice;
        $vendorInvoice->invoice_id          = 'MHS'.str_pad((string) $vendorInvoice->id,7,'0',STR_PAD_LEFT);
        $vendorInvoice->reciept_id          = $receiptNumber;
        $vendorInvoice->vendor_id           = $vendor_id;
        $vendorInvoice->featured_profile_id = $featuredProfile->id;
        $vendorInvoice->subscription_date   = $featuredProfile->start_date;
        $vendorInvoice->due_date            = $featuredProfile->due_date;
        $vendorInvoice->subscription_amount = $featuredProfile->amount;
        $vendorInvoice->status              = '1';
        $vendorInvoice->payment_method      = 'paypal';
        $vendorInvoice->save();
        $vendorInvoice->invoice_id          = 'MHS'.str_pad((string) $vendorInvoice->id,7,'0',STR_PAD_LEFT);
        $vendorInvoice->save();

        $vendorBill = new VendorBill;
        $vendorBill->vendor_id              = $vendor_id;
        $vendorBill->featured_profile_id    = $vendorInvoice->featured_profile_id;
        $vendorBill->invoice_id             = $vendorInvoice->id;
        $vendorBill->invoice_number         = $vendorInvoice->invoice_id.(date('m',strtotime("+$vbn months",strtotime(date('Y-m-d')))));
        $vendorBill->due_date               = date('Y-m-d', strtotime("+$vbn months", strtotime(date('Y-m-d'))));
        $vendorBill->paid_amount            = $vendorInvoice->subscription_amount;
        $vendorBill->paid_date              = date('Y-m-d');
        $vendorBill->status                 = '1';
        $vendorBill->comments               = "Weekly Featured Profile Purchased for $featuredProfile->weeks week(s) from $featuredProfile->start_date to $featuredProfile->due_date.";
        $vendorBill->save();
        $trackPayment->error = 'Payment was not successful';
        $trackPayment->save();
        return redirect('featured')->with('success','Your featured profile is successfully registered !!');
    }
}