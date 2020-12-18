<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Page;
use App\Vendor;
use App\VendorImage;
use App\VendorVideo;
use App\ReviewRequest;
use App\VendorFaq;
use App\VendorDeal;
use App\Subscription;
use App\PaymentMethod;
use App\VendorInvoice;
use App\VendorBill;
use App\FeaturedProfile;
use PDF;
use Auth;
use View;

class VbillingController extends Controller
{
    public $vendor_img;
    public $deals;
    public $photos;
    public $videos;
    public $vendor_id;
    public $vendor_progress_percentage;
    public $vendor_progress_basic;
    public $vendor_progress_images;
    public $vendor_progress_tenHDimages;
    public $vendor_progress_videos;
    public $vendor_progress_deals;
    public $vendor_progress_faqs;
    public $vendor_progress_reviewAsk;
    public $vendor_progress_address;
    public function __construct()
    {
        $this->middleware('auth:vendor');
        $this->middleware(function (Request $request, $next) {
            $this->vendor_id = Auth::id(); // you can access user id here
            $this->vendor_progress_percentage = 10;
            $this->vendor_img = Vendor::with(['image_data'=>function($q) { $q->where([/*'is_logo'=>1,*/'status'=>1]); }])->where('vendors.vendor_id',$this->vendor_id)->first();
           $this->deals = VendorDeal::join('deal_types','deal_types.id','=','vendor_deals.deal_type_id')
                                          ->select('vendor_deals.id','vendor_deals.name as deal_name','vendor_deals.photo','vendor_deals.status','deal_types.name as type','vendor_deals.expiry_date as end_date')
                                          ->where('vendor_id',$this->vendor_id)->count();
            $this->photos = VendorImage::where(['status'=>1,'vendor_id'=>$this->vendor_id])->orderBy('is_logo','asc')->count();
            $this->videos = VendorVideo::where('vendor_id',$this->vendor_id)->orderBy('sort_order','asc')->count();
            $query=Vendor::with(['company_data'])->where('vendors.vendor_id',$this->vendor_id);
            $category_data = $query->with(['category_data'=>function($q) {
                                $q->select('categories.id','categories.slug','cat.slug as parent_slug','cat.title as parent_title','categories.title','categories.parent_id','categories.meta_title','categories.meta_keyword','categories.meta_description')
                                ->join('categories AS cat', 'cat.id', '=', 'categories.parent_id');
                            }])->first();
            ////// Vendor Progressive Bar Start from here...
            $vendor_faqs = VendorFaq::where('vendor_id',$this->vendor_id)->count();
            $vendor_reviewAsk = ReviewRequest::where('vendor_id',$this->vendor_id)->count();
            //// for vendor progress basic info....
            if($this->vendor_img->contact_person != '' && $this->vendor_img->email != '' && $this->vendor_img->step_completed == '4') {
                $this->vendor_progress_basic = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_basic = 'no';
            }
            //// for vendor uploaded pics info....
            if(count($this->vendor_img->image_data) > 3) {
                $this->vendor_progress_images = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_images = 'no';
            }
            //// for vendor high-quality pics info....
            // if($this->photos > 9) {
            /*if($this->photos > 3) {
                $this->vendor_progress_tenHDimages = 'yes';
                $this->vendor_progress_percentage += 20;
            } else {
                $this->vendor_progress_tenHDimages = 'no';
            }*/
            //// for vendor videos info....
            if($this->videos > 0) {
                $this->vendor_progress_videos = 'yes';
                $this->vendor_progress_percentage += 50;
            } else {
                $this->vendor_progress_videos = 'no';
            }
            //// for vendor deal info....
            /*if($this->deals > 0) {
                $this->vendor_progress_deals = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_deals = 'no';
            }*/
            //// for vendor faq's info....
            /*if($vendor_faqs > 0) {
                $this->vendor_progress_faqs = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_faqs = 'no';
            }*/
            //// for vendor faq's info....
            if($vendor_reviewAsk > 0) {
                $this->vendor_progress_reviewAsk = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_reviewAsk = 'no';
            }
            //// for vendor business address info....
            if($category_data->company_data->business_address != '') {
                $this->vendor_progress_address = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_address = 'no';
            }
            View::share ( 'vendor_progress_percentage', $this->vendor_progress_percentage);
            View::share ( 'vendor_progress_basic', $this->vendor_progress_basic);
            View::share ( 'vendor_progress_images', $this->vendor_progress_images);
            View::share ( 'vendor_progress_tenHDimages', $this->vendor_progress_tenHDimages);
            View::share ( 'vendor_progress_videos', $this->vendor_progress_videos);
            View::share ( 'vendor_progress_deals', $this->vendor_progress_deals);
            View::share ( 'vendor_progress_faqs', $this->vendor_progress_faqs);
            View::share ( 'vendor_progress_reviewAsk', $this->vendor_progress_reviewAsk);
            View::share ( 'vendor_progress_address', $this->vendor_progress_address);
            return $next($request);
        });
    }

    public function get_invoices()
    {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId = \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data', 'category_data', 'image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $data['vendorBill'] = VendorBill::where('vendor_id',$vendorId)->where('status','!=','1')->orderBy('id','ASC')->get();
        $data['vendorInvc'] = VendorInvoice::where('vendor_id',$vendorId)->get();
        $data['vendorPaym'] = PaymentMethod::where('vendor_id',$vendorId)->get();
        return view('vendor.vendor_invoices', ['data'=>$data]);
    }

    public function download_invoice($id=null)
    {
        $id = decrypt($id);
        $pdfdata = array();
        $vendorId = \Auth::user()->vendor_id;
        $invcData = VendorInvoice::with('subscription')->where('id','=',$id)->first();
        $pdfdata['invoiceData'] = $invcData;
        $pdfdata['billData'] = VendorBill::with('carddata')->where('invoice_id','=',$id)->orderBy('id','ASC')->get();
        $pdfdata['pdfImage'] = url('public/images/logo.png');
        $pdfdata['vendorData'] = Vendor::with('company_data', 'category_data', 'image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        // return view('vendor.billinvoice.bill_invoice')->with(['pdfdata' => $pdfdata]);
        return view('vendor.featured.invoice_template')->with(['pdfdata' => $pdfdata]);
        $pdf = PDF::loadView('vendor.billinvoice.bill_invoice',compact('pdfdata'));
        // $customPaper = array(0,0,950,1500);
        // $pdf->setPaper($customPaper);
        return $pdf->download($invcData->invoice_id.'.pdf');
    }
    
    public function get_bills()
    {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId = \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data', 'category_data', 'image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $data['vendorBill'] = VendorBill::where('vendor_id',$vendorId)->where('status','!=','1')->orderBy('id','ASC')->get();
        $data['paidVendorBill'] = VendorBill::where('vendor_id',$vendorId)->where('status','=','1')->orderBy('id','ASC')->get();
        $data['vendorInvc'] = VendorInvoice::where('vendor_id',$vendorId)->get();
        $data['vendorPaym'] = PaymentMethod::where('vendor_id',$vendorId)->get();
        return view('vendor.vendor_bills', ['data'=>$data]);
    }

    public function payBy_card($id=null)
    {
        $decrptId = decrypt($id);
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId = \Auth::user()->vendor_id;
        $data['payData'] = VendorBill::where('vendor_id',$vendorId)->where('id','=',$decrptId)->first();
        $data['vendorBill'] = VendorBill::where('vendor_id',$vendorId)->where('status','!=','1')->orderBy('id','ASC')->get();
        $data['vendorInvc'] = VendorInvoice::where('vendor_id',$vendorId)->get();
        $data['vendorPaym'] = PaymentMethod::where('vendor_id',$vendorId)->get();
        return view('vendor.vendor_payBy_card', ['data'=>$data]);
    }

    public function payPayment(Request $request)
    {
        $cardId = '';
        $id = $request->billId;
        $vendorId = \Auth::user()->vendor_id;
        foreach($request->cardId as $nm => $py) {
            if($request->card_number[$nm] == 'on' || $request->card_number[$nm] == true) {
                $cardId = $request->cardId[$nm];
                break;
            }
        }
        $updBills = VendorBill::find($id);
        $updBills->paid_date = date('Y-m-d');
        $updBills->status    = '1';
        $updBills->card_id   = $cardId;
        $updBills->save();
        if($updBills->id) {
            return redirect('bills');
        } else {
            return redirect('payBy-card/'.encrypt($id));
        }
    }

    public function get_payment_method()
    {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId = \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data', 'category_data', 'image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $data['vendorBill'] = VendorBill::where('vendor_id',$vendorId)->where('status','!=','1')->orderBy('id','ASC')->get();
        $data['vendorInvc'] = VendorInvoice::where('vendor_id',$vendorId)->get();
        $data['vendorPaym'] = PaymentMethod::where('vendor_id',$vendorId)->get();
        return view('vendor.vendor_payment_method', ['data'=>$data]);
    }

    public function get_add_payment_method()
    {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId = \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data', 'category_data', 'image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $data['vendorBill'] = VendorBill::where('vendor_id',$vendorId)->where('status','!=','1')->orderBy('id','ASC')->get();
        $data['vendorInvc'] = VendorInvoice::where('vendor_id',$vendorId)->get();
        $data['vendorPaym'] = PaymentMethod::where('vendor_id',$vendorId)->get();
        return view('vendor.vendor_add_payment_method', ['data'=>$data]);
    }

    public function check_card_number(Request $request)
    {
        $cardNum = PaymentMethod::where('card_number','=',$request->cardNum)->exists();
        if($cardNum) {
            echo 'exist';
        }
    }

    public function save_payment_method(Request $request)
    {
        $vendorId = \Auth::user()->vendor_id;
        if($vendorId) {
            $paymnt = new PaymentMethod();
            $paymnt->vendor_id          = $vendorId;
            $paymnt->cardholder_name    = $request->cardholder_name;
            $paymnt->card_type          = $request->cardType;
            $paymnt->card_number        = $request->card_number;
            $paymnt->card_cvc           = $request->card_cvc;
            $paymnt->exp_month          = $request->exp_month;
            $paymnt->exp_year           = $request->exp_year;
            $paymnt->save();
            return 'done';
        } else {
            return 'error';
        }
    }

    public function update_payment_method(Request $request)
    {
        $payId = $request->payId;
        if($payId) {
            $paymnt = PaymentMethod::find($payId);
            $paymnt->exp_month  = $request->expiryMonth;
            $paymnt->exp_year   = $request->expiryYear;
            $paymnt->save();
            return 'done';
        } else {
            return 'error';
        }
    }
    public function listFeaturedItems()
    {
    	$featured = FeaturedProfile::where('status',1)->get();
    	$data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId = \Auth::user()->vendor_id;
        $data['vendorBill'] = VendorBill::where('vendor_id',$vendorId)->where('status','!=','1')->orderBy('id','ASC')->get();
        $data['vendorInvc'] = VendorInvoice::where('vendor_id',$vendorId)->get();
        $data['vendorPaym'] = PaymentMethod::where('vendor_id',$vendorId)->get();
    	return view('vendor.featured.featured',['featured' => $featured,'data' => $data]);
    }
}