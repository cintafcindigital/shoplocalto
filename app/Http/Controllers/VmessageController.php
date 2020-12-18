<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserChangePassword;
use App\Mail\EnquiryReply;
use App\Mail\EnquiryReplyResend;
use App\UserNewsletter;
use App\Page;
use App\Vendor;
use App\VendorImage;
use App\VendorCompany;
use App\VendorRating;
use App\VendorDeal;
use App\VendorVideo;
use App\VendorFaq;
use App\ReviewRequest;
use Carbon\Carbon;
use App\ContactEnquiryReply;
use App\VendorLocation;
use App\ContactEnquiry;
use App\EnquiryReplyimage;
use App\ReplyTemplate;
use App\Exports\LeadExport;
use Excel;
use Auth;
use View;
use DB;

class VmessageController extends Controller
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
                            }])
                        ->first();
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

    /*
    *   Message counting data Functions
    */
    public function messagesCounter() {

        $dateE = Carbon::now(); 
        $date = Carbon::now(); 
        $dateS = $date->modify("-12 months"); // Last day 12 months ago
        $vendorId =  \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $companyID = $data['vendorData'][0]['company_data']['id'];
        $data['inbox'] = \App\ContactEnquiry::with('user')->where('form_data',2)->where('company_id', $companyID)->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->count();
        $data['unread'] = \App\ContactEnquiry::where('form_data',2)->where('company_id', $companyID)->where('read_status', 0)->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->count();
        $data['read'] = \App\ContactEnquiry::where('form_data',2)->where('company_id', $companyID)->where('read_status', 1)->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->count();
        $data['pending'] = \App\ContactEnquiry::where('form_data',2)->where('company_id', $companyID)->where('reply_status', 0)->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->count();
        $data['replied'] = \App\ContactEnquiry::where('form_data',2)->where('company_id', $companyID)->where('reply_status', 1)->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->count();
        $data['booked'] = \App\ContactEnquiry::where('form_data',2)->where('company_id', $companyID)->where('reply_status', 3)->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->count();
        $data['discarded'] = \App\ContactEnquiry::where('form_data',2)->where('company_id', $companyID)->where('reply_status', 2)->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->count();
        return $data;
    }

    public function index()
    {
        $dateE = Carbon::now(); 
        $date = Carbon::now(); 
        $dateS = $date->modify("-12 months"); // Last day 12 months ago
        $vendorId =  \Auth::user()->vendor_id;
        //$data['userData'] = \Auth::user();
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $companyID = $data['vendorData'][0]['company_data']['id'];
        //// Advance Filter Query......
        if(isset($_GET['sn']) || isset($_GET['dfrom']) || isset($_GET['dend']) || isset($_GET['leadby']) ) {
            $readMessageQuery = \App\ContactEnquiry::with('user', 'replies')->where('form_data',2)->where('company_id', $companyID);
            if(isset($_GET['sn']) && trim($_GET['sn']) != '' ) {
                $name = $_GET['sn'];
                $readMessageQuery->where(function ($q) use ($name) {
                    $q->where('name', 'like', "$name%");
                });
            }
            if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' && isset($_GET['dend']) && $_GET['dend'] != ''  ) {
                $myDateTimeF = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                $myDateTimeE= \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                $dfrom = $myDateTimeF->format('Y-m-d');
                $dend = $myDateTimeE->format('Y-m-d');
                if($_GET['leadby'] == 1) {
                    $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                }else {
                    $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                }
            } else {
                if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' ) {
                    $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                    $dfrom = $myDateTime->format('Y-m-d');
                    $dend = Carbon::now();
                    if($_GET['leadby'] == 1) {
                        $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                    } else {
                        $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                    }
                }
                if( isset($_GET['dend']) && $_GET['dend'] != '' ) {
                     
                    $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                    $dfrom = '1970-01-01';
                    $dend = $myDateTime->format('Y-m-d');
                    if($_GET['leadby'] == 1) {
                        $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                    } else {
                        $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                    }
                }
            }
            $readdata = $readMessageQuery->orderBy('id','desc')->paginate(5);
            $data['inboxMessage'] = $readdata;
        } else {
           $data['inboxMessage'] = \App\ContactEnquiry::with('user', 'replies')->where('form_data',2)->where('company_id', $companyID)->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->paginate(5);
        }
        $messageCount = $this->messagesCounter();
        return view('vendor.messages',['data'=>$data, 'messageCount'=>$messageCount] );
    }

    /*
    *   Message status
    */
    public function messageStatus(Request $request) {
        //dd($request->all());

        if( isset($request->messageids) && count($request->messageids) > 0 ) {

            foreach ($request->messageids as $key => $id) {
                $messagesObj = ContactEnquiry::find($id);
                if($request->action != 'read' && $request->action != 'unread' ) {
                    $messagesObj->reply_status = $request->actionvalue;     // For Pending, Replied, Booked, Discarded
                }else {
                    $messagesObj->read_status = $request->actionvalue;  
                }
                $messagesObj->save();
            }
        }
        return redirect()->back();
    }

    /**
     * show messages.
    */
    public function messages_details($id)
    {
        $vendorId =  \Auth::user()->vendor_id;
        //$data['userData'] = \Auth::user();

        $contactEnquiryobj = \App\ContactEnquiry::find($id);
        $contactEnquiryobj->read_status = 1;
        $contactEnquiryobj->save();


        $data['companyData'] = \App\CompanySetting::select('phone_number')->where('id',1)->first();
        $data['vendorData'] = Vendor::with('company_data','image_data', 'category_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['message'] = \App\ContactEnquiry::where('form_data',2)->where('company_id',$data['vendorData'][0]['company_data']['id'])->count();

        $data['message_details'] = \App\ContactEnquiry::with('user')->where('form_data',2)->where('company_id',$data['vendorData'][0]['company_data']['id'])->where('id',$id)->first();

        if(empty($data['message_details'])){ abort('404');}

        $data['reply'] = \App\ContactEnquiryReply::with('user', 'reply_images')->where('company_id',$data['vendorData'][0]['company_data']['id'])->where('enquiry_id',$id)->orderBy('id','desc')->get()->toArray();

        $userProfile = \App\User::select(\DB::raw('case when NULLIF(profile_image,"") IS NULL THEN "no-image.png" ELSE CONCAT(CONCAT("USER","_",id),"/",profile_image) END AS profile_image'))->where('id',$data['message_details']->user_id)->first();

        $data['messageTemplate'] = ReplyTemplate::where('vendor_id', $vendorId)->get()->toArray();

        $messageCount = $this->messagesCounter();

        return view('vendor.messages_details',['data'=>$data, 'messageCount'=>$messageCount, 'profile_image'=>$userProfile['profile_image']] );


        //return view('vendor.messages_details',['data'=>$data,'profile_image'=>$userProfile['profile_image']]);
    }

    /*
    *   Message status { Read, Unread }
    */

    public function messageStatusdetails($eqid, $status) {

        $contactEnquiryobj = \App\ContactEnquiry::find($eqid);
        $contactEnquiryobj->read_status = $status;
        $contactEnquiryobj->save();
        return $status;
    }

    /*
    *   status change on single pages { Pending, replied, discarted, booking }
    */

    public function messageDetailsStatus($eqid, $status) {
        
        $contactEnquiryobj = \App\ContactEnquiry::find($eqid);
        $contactEnquiryobj->reply_status  = $status;
        $contactEnquiryobj->save();
        
        if($status == 0) {
             return \Redirect::back()->with('message','Lead moved to Pending.');
        }
        if($status == 1) {
             return \Redirect::back()->with('message','Lead moved to Replied.');
        }
        if($status == 2) {
             return \Redirect::back()->with('message','Lead moved to Discarded.');
        }
        if($status == 3) {
             return \Redirect::back()->with('message','Lead moved to Booked.');
        }

    }

     /**
     * Delete Mailbox
     */

    public function delete_messages(Request $request){
      $vendorId =  \Auth::user()->vendor_id;
      $ids = $request->input('inbox_id');
      if(isset($ids) && !empty($ids)){
        $vendorData = Vendor::with('company_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        \App\ContactEnquiry::where('company_id',$vendorData[0]['company_data']['id'])->whereIn('id', $ids)->delete();
        return \Redirect()->back()->with('message','<span class="alert alert-success">Mail Deleted.</span>');
      }else{
        return \Redirect::back()->with('message','<span class="alert alert-danger">Oops! Something went wrong please try again.</span>');
      }
    } 


    /*
    *   Reply file Upload
    */

    public function replyFileupload(Request $request) {

        // print_r($request->file('fileobj')->getClientOriginalName());
        // dd($request->all());
        $reponce = array();

        $file_data = $request->file('fileobj'); 
        $input['image'] = time().'_replymesage.'.$file_data->getClientOriginalExtension();
        $input['id'] = time().'_replymesage';
        $destinationPath = public_path('/replyimages');
        $file_data->move($destinationPath, $input['image']);

        $replyObj = new EnquiryReplyimage;
        $replyObj->image_name = $input['image'];
        $replyObj->original_name = $file_data->getClientOriginalName();
        $replyObj->save();

        if(isset($request->checker) && $request->checker != '') {   // From message single page

            if($file_data!=""){ // storing image in storage/app/public Folder 
                $reponce['html'] = '<span class="admin-sol-template-tag">'.$file_data->getClientOriginalName().'
                                    <a class="icon icon-close-small inbox-message-link__remove" role="button" data-remove="'.$input['id'].'"></a>
                                </span>';
                $reponce['fileid'] = $replyObj->id;
                $reponce['id'] = $input['id'];
            }else {
                $reponce['html'] = 'yes';
            }

        }else { // From message single page

            if($file_data!=""){ // storing image in storage/app/public Folder 
                $reponce['html'] = '<div class="app-admin-sol-template-tag inbox-message-link">
                                        <span class="icon icon-clip icon-left inbox-message-link__label fleft">'. $file_data->getClientOriginalName().'</span>
                                        <a class="icon icon-close-small inbox-message-link__remove app-admin-sol-attached-del" data-remove="'.$input['id'].'"></a>
                                    </div>';
                $reponce['fileid'] = $replyObj->id;
                $reponce['id'] = $input['id'];
            }else {
                $reponce['html'] = 'yes';
            }
        }

       echo json_encode($reponce);  
    }

     /**
     * Reply Message
     */

    protected function send_reply_message(Request $request){

      //  dd($request->all());

        $vendorId =  \Auth::user()->vendor_id;
        $this->validate($request, [
             'enq_name' => 'required|string',
             'enq_email' => 'required|email',
             'reply_message' => 'required',
         ],['enq_name.required'=>'Name field is required.',
         'enq_email.required'=>'Email address field is required.',
         'reply_message.required'=>'Message field is required.']);
          ///////////////////////////////////////
           $enquiry =  \App\ContactEnquiry::where('id', $request->input('enqury_id'))->get()->toArray();
           if(isset($enquiry[0]) && !empty($enquiry[0])){
               $reObj = new \App\ContactEnquiryReply;
               $reObj->enquiry_id = $request->input('enqury_id');
               $reObj->user_id = $enquiry[0]['user_id'];
               $reObj->name = $request->input('enq_name');
               $reObj->email = $request->input('enq_email');
               $reObj->company_id = ($enquiry[0]['company_id'] != null)?$enquiry[0]['company_id']:0;
               $reObj->reply_by = $vendorId;
               $reObj->message = $request->input('reply_message');
               $reObj->save();
           }

           $mailDataImage = array();
           $i = 0;
           if(isset($request->inputFiles)) {
               foreach ($request->inputFiles as $key => $inputFilesvalue) {

                   $imageObj = EnquiryReplyimage::find($inputFilesvalue);
                   $imageObj->enquiry_id = $request->input('enqury_id');
                   $imageObj->enquiry_reply_id = $reObj->id;
                   $imageObj->save();

                   $mailDataImage[$i]['imagename'] = $imageObj->image_name;
                   $mailDataImage[$i]['originalname'] = $imageObj->original_name;
                   $i++;
               }
            }

        // Save template if vendor want
           if($request->is_template != 'yes' && $request->savetemplate == 'yes') {

                $message = strip_tags($request->input('reply_message'));
                $title =  str_limit($message, $limit = 120, $end = '...');

                $temCreateobj = new ReplyTemplate;
                $temCreateobj->vendor_id  = $vendorId;
                $temCreateobj->template_name = $title;
                $temCreateobj->template_message = $request->input('reply_message');
                $temCreateobj->save();

                if($temCreateobj->id) {

                    if(isset($request->inputFiles)) {
                        foreach ($request->inputFiles as $key => $filevalueid) {
                            $fileObj = EnquiryReplyimage::find($filevalueid);
                            $fileObj->template_id = $temCreateobj->id;
                            $fileObj->save();
                        }
                    }

                }

           }


          ///////////////////////////////////////
          $mailData['name'] = $request->input('enq_name');
          $mailData['email'] = $request->input('enq_email');
          $mailData['message'] = $request->input('reply_message');
          $mailData['fileData'] = $mailDataImage;

          // CC mail send
          $ccAddress = $request->input('cc');
          try {
              if($ccAddress){
                 Mail::to($request->input('enq_email'))->cc([$ccAddress])->send(new EnquiryReply($mailData));
              }else{
                 Mail::to($request->input('enq_email'))->send(new EnquiryReply($mailData));
               }
              if(Mail::failures()) {
                 return redirect()->back()->with('reply', '<div class="alert alert-danger">Something went wrong please try again.</div>');
              }else{
                 $enObj =  \App\ContactEnquiry::find($request->input('enqury_id'));
                 $enObj->reply_status = 1;
                 $enObj->save();
                 return redirect()->back()->with('reply', '<div class="alert alert-success">Reply Message Sent Successfully.</div>');
              }
          } catch (\Exception $e) {
                return redirect()->back()->with('reply', '<div class="alert alert-danger">Something went wrong please try again.</div>');
          }
    }

    /**
     * Show the Message Unread page.
     */

     public function get_unreadmsg() {

        $dateE = Carbon::now(); 
        $date = Carbon::now(); 
        $dateS = $date->modify("-12 months"); // Last day 12 months ago

        $data['titleData'] = \App\Page::where('id', 10)->first();

        $vendorId =  \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $companyID = $data['vendorData'][0]['company_data']['id'];

        // Advance Filter Query

            if(isset($_GET['sn']) || isset($_GET['dfrom']) || isset($_GET['dend']) || isset($_GET['leadby']) ) {

                $readMessageQuery = \App\ContactEnquiry::with('user', 'replies')->where('form_data',2)->where('read_status', 0)->where('company_id', $companyID);

                if(isset($_GET['sn']) && trim($_GET['sn']) != '' ) {

                    $name = $_GET['sn'];
                    $readMessageQuery->where(function ($q) use ($name) {
                        $q->where('name', 'like', "$name%");
                    });

                }

                if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' && isset($_GET['dend']) && $_GET['dend'] != ''  ) {

                    $myDateTimeF = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                    $myDateTimeE= \DateTime::createFromFormat('d/m/Y', $_GET['dend']);

                    $dfrom = $myDateTimeF->format('Y-m-d');
                    $dend = $myDateTimeE->format('Y-m-d');

                    if($_GET['leadby'] == 1) {

                        $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                    }else {
                        $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                    }

                } else {

                    if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' ) {

                        $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                        $dfrom = $myDateTime->format('Y-m-d');
                        $dend = Carbon::now();
                        if($_GET['leadby'] == 1) {
                            $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                        }else {
                            $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                        }
                    }

                    if( isset($_GET['dend']) && $_GET['dend'] != '' ) {
                         
                        $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                        $dfrom = '1970-01-01';
                        $dend = $myDateTime->format('Y-m-d');
                        if($_GET['leadby'] == 1) {
                            $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                        }else {
                            $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                        }
                    }
                }

                $readdata = $readMessageQuery->orderBy('id','desc')->paginate(5);
                $data['unreadMessage'] = $readdata;

            } else {

                $data['unreadMessage'] = \App\ContactEnquiry::with('user', 'replies')->where('form_data',2)->where('read_status', 0)->where('company_id', $companyID)->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->paginate(5);
            }

        $messageCount = $this->messagesCounter();

        return view('vendor.message_unread',['data'=>$data, 'messageCount'=>$messageCount] );
     }

     /**
     * Show the Message Read page.
     */

    public function get_readmsg() {

        $dateE = Carbon::now(); 
        $date = Carbon::now(); 
        $dateS = $date->modify("-12 months"); // Last day 12 months ago

        $data['titleData'] = \App\Page::where('id', 10)->first();

        $vendorId =  \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $companyID = $data['vendorData'][0]['company_data']['id'];

        // Advance Filter Query
            if(isset($_GET['sn']) || isset($_GET['dfrom']) || isset($_GET['dend']) || isset($_GET['leadby']) ) {

                $readMessageQuery = \App\ContactEnquiry::with('user', 'replies')->where('form_data',2)->where('read_status', 1)->where('company_id', $companyID);

                if(isset($_GET['sn']) && trim($_GET['sn']) != '' ) {

                    $name = $_GET['sn'];
                    $readMessageQuery->where(function ($q) use ($name) {
                        $q->where('name', 'like', "$name%");
                    });

                }

                if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' && isset($_GET['dend']) && $_GET['dend'] != ''  ) {

                    $myDateTimeF = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                    $myDateTimeE= \DateTime::createFromFormat('d/m/Y', $_GET['dend']);

                    $dfrom = $myDateTimeF->format('Y-m-d');
                    $dend = $myDateTimeE->format('Y-m-d');

                    if($_GET['leadby'] == 1) {

                        $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                    }else {
                        $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                    }

                } else {

                    if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' ) {

                        $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                        $dfrom = $myDateTime->format('Y-m-d');
                        $dend = Carbon::now();
                        if($_GET['leadby'] == 1) {
                            $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                        }else {
                            $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                        }
                    }

                    if( isset($_GET['dend']) && $_GET['dend'] != '' ) {
                         
                        $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                        $dfrom = '1970-01-01';
                        $dend = $myDateTime->format('Y-m-d');
                        if($_GET['leadby'] == 1) {
                            $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                        }else {
                            $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                        }
                    }
                }

                $readdata = $readMessageQuery->orderBy('id','desc')->paginate(5);
                $data['readMessage'] = $readdata;

            } else {

                $data['readMessage'] = \App\ContactEnquiry::with('user', 'replies')->where('form_data',2)->where('read_status', 1)->where('company_id', $companyID)->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->paginate(5);
            }

        $messageCount = $this->messagesCounter();

        return view('vendor.message_read',['data'=>$data, 'messageCount'=>$messageCount] );
    }

    /**
    * Show the Pending page.
    */
    public function get_pendingmsg()
    {
        $dateE = Carbon::now(); 
        $date = Carbon::now(); 
        $dateS = $date->modify("-12 months"); // Last day 12 months ago
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId =  \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $companyID = $data['vendorData'][0]['company_data']['id'];
        // Advance Filter Query
        if(isset($_GET['sn']) || isset($_GET['dfrom']) || isset($_GET['dend']) || isset($_GET['leadby']) ) {
            $readMessageQuery = \App\ContactEnquiry::with('user', 'replies')->where('form_data',2)->where('reply_status', 0)->where('company_id', $companyID);
            if(isset($_GET['sn']) && trim($_GET['sn']) != '' ) {
                $name = $_GET['sn'];
                $readMessageQuery->where(function ($q) use ($name) {
                    $q->where('name', 'like', "$name%");
                });
            }
            if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' && isset($_GET['dend']) && $_GET['dend'] != ''  ) {
                $myDateTimeF = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                $myDateTimeE= \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                $dfrom = $myDateTimeF->format('Y-m-d');
                $dend = $myDateTimeE->format('Y-m-d');
                if($_GET['leadby'] == 1) {
                    $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                } else {
                    $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                }
            } else {
                if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' ) {
                    $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                    $dfrom = $myDateTime->format('Y-m-d');
                    $dend = Carbon::now();
                    if($_GET['leadby'] == 1) {
                        $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                    } else {
                        $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                    }
                }
                if( isset($_GET['dend']) && $_GET['dend'] != '' ) {
                    $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                    $dfrom = '1970-01-01';
                    $dend = $myDateTime->format('Y-m-d');
                    if($_GET['leadby'] == 1) {
                        $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                    } else {
                        $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                    }
                }
            }
            $readdata = $readMessageQuery->orderBy('id','desc')->paginate(5);
            $data['pendingMessage'] = $readdata;
        } else {
            $data['pendingMessage'] = \App\ContactEnquiry::with('user', 'replies')->where('form_data',2)->where('reply_status', 0)->where('company_id', $companyID)->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->paginate(5);
        }
        $messageCount = $this->messagesCounter();
        return view('vendor.message_pending',['data'=>$data, 'messageCount'=>$messageCount] );
     }

    /**
    * Show the Replied page.
    */
    public function get_repliedmsg()
    {
        $dateE = Carbon::now();
        $date = Carbon::now();
        $dateS = $date->modify("-12 months"); // Last day 12 months ago

        $data['titleData'] = \App\Page::where('id', 10)->first();

        $vendorId =  \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $companyID = $data['vendorData'][0]['company_data']['id'];

        // Advance Filter Query
            if(isset($_GET['sn']) || isset($_GET['dfrom']) || isset($_GET['dend']) || isset($_GET['leadby']) ) {

                $readMessageQuery = \App\ContactEnquiry::with('user', 'replies')->where('form_data',2)->where('reply_status', 1)->where('company_id', $companyID);

                if(isset($_GET['sn']) && trim($_GET['sn']) != '' ) {

                    $name = $_GET['sn'];
                    $readMessageQuery->where(function ($q) use ($name) {
                        $q->where('name', 'like', "$name%");
                    });

                }

                if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' && isset($_GET['dend']) && $_GET['dend'] != ''  ) {

                    $myDateTimeF = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                    $myDateTimeE= \DateTime::createFromFormat('d/m/Y', $_GET['dend']);

                    $dfrom = $myDateTimeF->format('Y-m-d');
                    $dend = $myDateTimeE->format('Y-m-d');

                    if($_GET['leadby'] == 1) {

                        $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                    }else {
                        $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                    }

                } else {

                    if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' ) {

                        $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                        $dfrom = $myDateTime->format('Y-m-d');
                        $dend = Carbon::now();
                        if($_GET['leadby'] == 1) {
                            $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                        }else {
                            $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                        }
                    }

                    if( isset($_GET['dend']) && $_GET['dend'] != '' ) {
                         
                        $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                        $dfrom = '1970-01-01';
                        $dend = $myDateTime->format('Y-m-d');
                        if($_GET['leadby'] == 1) {
                            $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                        }else {
                            $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                        }
                    }
                }

                $readdata = $readMessageQuery->orderBy('id','desc')->paginate(5);
                $data['repliedMessage'] = $readdata;

            } else {

                $data['repliedMessage'] = \App\ContactEnquiry::with('user', 'replies')->where('form_data',2)->where('reply_status', 1)->where('company_id', $companyID)->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->paginate(5);
            }

        $messageCount = $this->messagesCounter();

        return view('vendor.message_replied',['data'=>$data, 'messageCount'=>$messageCount] );
     }

     /**
     * Show the Booked page.
     */

     public function get_bookedmsg() {

        $dateE = Carbon::now(); 
        $date = Carbon::now(); 
        $dateS = $date->modify("-12 months"); // Last day 12 months ago

        $data['titleData'] = \App\Page::where('id', 10)->first();

        $vendorId =  \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $companyID = $data['vendorData'][0]['company_data']['id'];

        // Advance Filter Query
            if(isset($_GET['sn']) || isset($_GET['dfrom']) || isset($_GET['dend']) || isset($_GET['leadby']) ) {

                $readMessageQuery = \App\ContactEnquiry::with('user', 'replies')->where('form_data',2)->where('reply_status', 3)->where('company_id', $companyID);

                if(isset($_GET['sn']) && trim($_GET['sn']) != '' ) {

                    $name = $_GET['sn'];
                    $readMessageQuery->where(function ($q) use ($name) {
                        $q->where('name', 'like', "$name%");
                    });

                }

                if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' && isset($_GET['dend']) && $_GET['dend'] != ''  ) {

                    $myDateTimeF = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                    $myDateTimeE= \DateTime::createFromFormat('d/m/Y', $_GET['dend']);

                    $dfrom = $myDateTimeF->format('Y-m-d');
                    $dend = $myDateTimeE->format('Y-m-d');

                    if($_GET['leadby'] == 1) {

                        $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                    }else {
                        $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                    }

                } else {

                    if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' ) {

                        $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                        $dfrom = $myDateTime->format('Y-m-d');
                        $dend = Carbon::now();
                        if($_GET['leadby'] == 1) {
                            $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                        }else {
                            $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                        }
                    }

                    if( isset($_GET['dend']) && $_GET['dend'] != '' ) {
                         
                        $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                        $dfrom = '1970-01-01';
                        $dend = $myDateTime->format('Y-m-d');
                        if($_GET['leadby'] == 1) {
                            $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                        }else {
                            $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                        }
                    }
                }

                $readdata = $readMessageQuery->orderBy('id','desc')->paginate(5);
                $data['bookedMessage'] = $readdata;

            } else {

                $data['bookedMessage'] = \App\ContactEnquiry::with('user', 'replies')->where('form_data',2)->where('reply_status', 3)->where('company_id', $companyID)->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->paginate(5);
            }


        $messageCount = $this->messagesCounter();

        return view('vendor.message_booked',['data'=>$data, 'messageCount'=>$messageCount] );
     }

     /**
     * Show the Discarded page.
     */

     public function get_discardedmsg() {

        $dateE = Carbon::now(); 
        $date = Carbon::now(); 
        $dateS = $date->modify("-12 months"); // Last day 12 months ago

        $data['titleData'] = \App\Page::where('id', 10)->first();

        $vendorId =  \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $companyID = $data['vendorData'][0]['company_data']['id'];

        // Advance Filter Query
            if(isset($_GET['sn']) || isset($_GET['dfrom']) || isset($_GET['dend']) || isset($_GET['leadby']) ) {

                $readMessageQuery = \App\ContactEnquiry::with('user', 'replies')->where('form_data',2)->where('reply_status', 2)->where('company_id', $companyID);

                if(isset($_GET['sn']) && trim($_GET['sn']) != '' ) {

                    $name = $_GET['sn'];
                    $readMessageQuery->where(function ($q) use ($name) {
                        $q->where('name', 'like', "$name%");
                    });

                }

                if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' && isset($_GET['dend']) && $_GET['dend'] != ''  ) {

                    $myDateTimeF = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                    $myDateTimeE= \DateTime::createFromFormat('d/m/Y', $_GET['dend']);

                    $dfrom = $myDateTimeF->format('Y-m-d');
                    $dend = $myDateTimeE->format('Y-m-d');

                    if($_GET['leadby'] == 1) {

                        $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                    }else {
                        $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                    }

                } else {

                    if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' ) {

                        $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                        $dfrom = $myDateTime->format('Y-m-d');
                        $dend = Carbon::now();
                        if($_GET['leadby'] == 1) {
                            $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                        }else {
                            $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                        }
                    }

                    if( isset($_GET['dend']) && $_GET['dend'] != '' ) {
                         
                        $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                        $dfrom = '1970-01-01';
                        $dend = $myDateTime->format('Y-m-d');
                        if($_GET['leadby'] == 1) {
                            $readMessageQuery->whereBetween('created_at', array($dfrom, $dend));
                        }else {
                            $readMessageQuery->whereBetween('event_date', array($dfrom, $dend));
                        }
                    }
                }

                $readdata = $readMessageQuery->orderBy('id','desc')->paginate(5);
                $data['discardedMessage'] = $readdata;

            } else {

                $data['discardedMessage'] = \App\ContactEnquiry::with('user', 'replies')->where('form_data',2)->where('reply_status', 2)->where('company_id', $companyID)->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->paginate(5);
            }


        $messageCount = $this->messagesCounter();

        return view('vendor.message_discarded',['data'=>$data, 'messageCount'=>$messageCount] );
     }

     /**
     * Show the Entries page.
     */

     public function get_entries() {
        $data['titleData'] = \App\Page::where('id', 10)->first();
        return view('vendor.message_entries', ['data'=>$data]);
     }

     /**
     * Show the Message Setting page.
     */

     public function get_msgsetting() {

        $data['titleData'] = \App\Page::where('id', 10)->first();

        $vendorId =  \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();

        $messageCount = $this->messagesCounter();

        return view('vendor.message_setting',['data'=>$data, 'messageCount'=>$messageCount] );
     }

     /**
     *  save settings message
     */

     public function post_msgsetting(Request $request) {

        $vendorId =  \Auth::user()->vendor_id;
        $vendorObj = Vendor::find($vendorId);
        $vendorObj->message_notify_email = $request->notify_mail;
        $vendorObj->save();

        if($vendorObj->vendor_id) {
            return redirect()->back()->with('success', 'Emails have been updated');   
        }
     }


     /**
     * Show the Message Template page.
     */

    public function get_msgtemplates() {

        $data['titleData'] = \App\Page::where('id', 10)->first();
        $vendorId =  \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();

        $data['alltemplates'] = ReplyTemplate::with('reply_images')->where('vendor_id', $vendorId)->orderBy('id', 'desc')->get()->toArray();;

        $messageCount = $this->messagesCounter();
        return view('vendor.message_templates',['data'=>$data, 'messageCount'=>$messageCount] );
     }

    /*
    *   Post message template Data
    */

    public function post_msgtemplates(Request $request) {
       // dd($request->all());

        $replyTemplateobj = new ReplyTemplate;
        $replyTemplateobj->vendor_id = $request->vender_id;
        $replyTemplateobj->template_name = $request->template_name;
        $replyTemplateobj->template_subject = $request->template_subject;
        $replyTemplateobj->template_message = $request->templatemesage;
        $replyTemplateobj->save();

        if(isset($request->inputFiles)) {
            foreach ($request->inputFiles as $key => $filevalueid) {
                $fileObj = EnquiryReplyimage::find($filevalueid);
                $fileObj->template_id = $replyTemplateobj->id;
                $fileObj->save();
            }
        }

        if($replyTemplateobj->id) {
           return redirect()->back()->with('success', 'Template created Successfully');  
        }
    }

    /*
    *   Get Message Template for update
    */

    public function get_messageTemplate($id) {

        $templateData = ReplyTemplate::with('reply_images')->where('id', $id)->get()->toArray();;
        $responce = array();
        $html = '';
        $htmlid = array();

        $html = '<form class="pure-form" name="templateFormupdate" id="templateFormupdate" action="'.url('update-messages-templates').'" method="post" enctype="multipart/form-data">'.csrf_field();

                        $html .= ' <div class="hidenfilesarray" style="display: none;">';

                            if(count($templateData[0]['reply_images']) > 0) {

                                foreach ($templateData[0]['reply_images'] as $key => $repvalue) {
                                    $htmlid = explode('.', $repvalue['image_name']);
                                    $html .= '<input id="'.$htmlid[0].'" type="hidden" name="inputFiles[]" value="'.$repvalue['id'].'" />';
                                }

                            }

                        $html .= '</div>';

                        $html .=  '<input type="hidden" name="vender_id" value="'.$templateData[0]['vendor_id'].'" />';
                        $html .=  '<input type="hidden" name="template_id" value="'.$id.'" />';

                        $html .=  '<div class="mb15 pure-control-group">
                                <label class="adminFormLabel">Template Name</label>
                                <input size="45" type="text" name="template_nameupdate" id="template_nameupdate" value="'.$templateData[0]['template_name'].'">
                            </div>

                            <div class="mb15 pure-control-group">
                                <label class="adminFormLabel">Subject</label>
                                <input size="45" type="text" name="template_subjectupdate" id="template_subjectupdate" value="'.$templateData[0]['template_subject'].'">
                            </div>

                            <div class="mb15 pure-control-group">
                                <label class="adminFormLabel">Text</label>
                                <div style="border: 1px solid #ccc">
                                    <textarea class="mt5" rows="10" name="templatemesageupdate" id="templatemesageupdate" aria-hidden="true"></textarea>
                                </div>
                            </div>';

                            $html .= '<div id="ficheroSubido" class="mt10 mb10">';

                                if(count($templateData[0]['reply_images']) > 0) {

                                    foreach ($templateData[0]['reply_images'] as $key => $repvalue) {

                                        $htmlid = explode('.', $repvalue['image_name']);
                                        $html .= '<span class="admin-sol-template-tag">'.$repvalue['original_name'].'
                                                    <a class="icon icon-close-small inbox-message-link__remove" role="button" data-remove="'.$htmlid[0].'"></a>
                                                </span>';
                                    }
                                }
                                    
                            $html .= '</div>';

                            $html .= '<div class="pure-control-group">
                                <div id="ficheroAdjunto" class="adminFormFile icon icon-clip">
                                   <label for="ficheroAdjunto">Attach files</label>
                                   <input name="templatefiles" id="templatefiles" type="file" onchange="templateFileupload(this)">
                                </div>
                            </div>

                            <input class="btnFlat btnFlat--primary mr10 add_templ" type="submit" value="Update template" onclick="return updatemessageTemplate();">
                            <input class="btnFlat btnFlat--primary mr10 add_templ" type="button" value="Delete template" onclick="return deletemessageTemplate('.$id.');">
                            <input class="btnFlat btnFlat--grey app-plantillas-cancelar update_cancel_templ" type="button" value="Cancel">

                    </form>';

        $responce['html'] = $html;
        $responce['templatedata'] = $templateData;

        echo json_encode($responce);

    }

    /*
    *   Update message template
    */

    public function update_msgtemplates(Request $request) {
       // dd($request->all());
        $temObj = ReplyTemplate::find($request->template_id);
        $temObj->template_name = $request->template_nameupdate;
        $temObj->template_subject = $request->template_subjectupdate;
        $temObj->template_message = $request->templatemesageupdate;
        $temObj->save();

        $tempallImg = EnquiryReplyimage::where('template_id', $request->template_id)->get();

        foreach ($tempallImg as $key => $tempallImgValue) {
            $imgObj = EnquiryReplyimage::find($tempallImgValue->id);
            $imgObj->template_id = NULL;
            $imgObj->save();
        }

        if(isset($request->inputFiles)) {
            foreach ($request->inputFiles as $key => $filevalueid) {
                $fileObj = EnquiryReplyimage::find($filevalueid);
                $fileObj->template_id = $request->template_id;
                $fileObj->save();
            }
        }

        if($temObj->id) {
            return redirect()->back()->with('success', 'Template Updated Successfully');
        }else {
            return redirect()->back()->with('error', 'Something went wrong...');
        }
    }

    /*
    *   Delete Message Template
    */

    public function delete_messageTemplate($templateid) {

        $tempDeletObj = ReplyTemplate::find($templateid);
        $tempDeletObj->delete();
        return redirect()->back()->with('success', 'Template Deleted Successfully');
    }


    /*
    *   Set Message Template to message Reply
    */

    public function set_messageTemplate($templateid) {
      //  echo $templateid;
        $responce = array();
        $html = '';
        $inputHtml = '';
        $tempsetObj = ReplyTemplate::with('reply_images')->where('id', $templateid)->get();

        $responce['messageContent'] = $tempsetObj[0]->template_message;

        if(count($tempsetObj[0]->reply_images) > 0) {

            foreach ($tempsetObj[0]->reply_images as $key => $replyImages) {
                $removeId = explode('.', $replyImages->image_name);
                $html .= '<div class="app-admin-sol-template-tag inbox-message-link">
                            <span class="icon icon-clip icon-left inbox-message-link__label fleft">'.$replyImages->original_name.'</span>
                            <a class="icon icon-close-small inbox-message-link__remove app-admin-sol-attached-del" data-remove="'.$removeId[0].'"></a>
                        </div>';

                $inputHtml .= '<input id="'.$removeId[0].'" type="hidden" name="inputFiles[]" value="'.$replyImages->id.'">';
            }
        }

        $responce['inputHidden'] = $inputHtml;
        $responce['imageHtml'] = $html;

        return json_encode($responce);
    }


    /*
    *   Add note on message single
    */
    public function add_message_note(Request $request) {
        
        //dd($request->all());
        $vendorId =  \Auth::user()->vendor_id;
        $this->validate($request, [
             'message_note' => 'required',
         ],['message_note.required'=>'Message field is required.']);
          ///////////////////////////////////////
           $enquiry =  \App\ContactEnquiry::where('id', $request->input('note_enqury_id'))->get()->toArray();
           if(isset($enquiry[0]) && !empty($enquiry[0])){
               $reObj = new \App\ContactEnquiryReply;
               $reObj->enquiry_id = $request->input('note_enqury_id');
               $reObj->user_id = $enquiry[0]['user_id'];
               $reObj->name = $request->input('note_enq_name');
               $reObj->email = $request->input('note_enq_email');
               $reObj->company_id = ($enquiry[0]['company_id'] != null)?$enquiry[0]['company_id']:0;
               $reObj->reply_by = $vendorId;
               $reObj->message_type = 'notes';
               $reObj->message = $request->input('message_note');
               $reObj->save();
           }

            if($reObj->id) {
                return redirect()->back()->with('reply', '<div class="alert alert-success">Note Added Successfully.</div>');
            }else{
                return redirect()->back()->with('reply', '<div class="alert alert-danger">Something went wrong please try again.</div>');
            }
    }

    /*
    *   Resend lead
    */

    public function resend_lead(Request $request) {

       // dd($request->all());

        $vendorId =  \Auth::user()->vendor_id;
        $this->validate($request, [
             'resend_mail' => 'required',
         ],['resend_mail.required'=>'Email is Required']);


        $data['vendorData'] = Vendor::with('company_data', 'category_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();

        $data['message_details'] = \App\ContactEnquiry::with('user')->where('form_data',2)->where('company_id',$data['vendorData'][0]['company_data']['id'])->where('id',$request->resend_enqury_id)->first();

        $mailData['business_name'] = $data['vendorData'][0]['company_data']['business_name'];
        $mailData['enq_name'] = $data['message_details']->user->name;
        $mailData['enq_email'] = $data['message_details']->user->email;
        $mailData['enq_phone'] = $data['message_details']->user->phone;
        $mailData['enq_eventdate'] = $data['message_details']->user->event_date;
        $mailData['enq_message'] = $data['message_details']->comment;
        $mailData['enq_url'] = url('/message-details').'/'.$request->resend_enqury_id;
        $mailData['business_category'] = $data['vendorData'][0]['category_data']['title'];
        $mailData['business_province'] = $data['vendorData'][0]['company_data']['province'];

        try {
            Mail::to($request->resend_mail)->send(new EnquiryReplyResend($mailData));

            if(Mail::failures()) {
                return redirect()->back()->with('reply', '<div class="alert alert-danger">Something went wrong please try again.</div>');
            }else{
                 return redirect()->back()->with('reply', '<div class="alert alert-success">Lead Sent Successfully.</div>');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('reply', '<div class="alert alert-danger">Something went wrong please try again.</div>');
        }

    }

    /*
    *   Print lead 
    */

    public function get_print_leads($leadid) {

        $vendorId =  \Auth::user()->vendor_id;
        

        $data['vendorData'] = Vendor::with('company_data', 'category_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();

        $data['message_details'] = \App\ContactEnquiry::with('user')->where('form_data',2)->where('company_id',$data['vendorData'][0]['company_data']['id'])->where('id',$leadid)->first();

        $data['reply'] = \App\ContactEnquiryReply::with('user', 'reply_images')->where('company_id',$data['vendorData'][0]['company_data']['id'])->where('enquiry_id',$leadid)->orderBy('id','desc')->get()->toArray();

        return view('vendor.message_print', ['data' => $data]);
    }


    /*
    *   Move status to booked using message single page
    */

    public function booking_status(Request $request) {
       // dd($request->all());

        $responce = array();

        $messageObj = ContactEnquiry::find($request->leadid);
        if(ContactEnquiry::where('id', $request->leadid)->where('reply_status', 3)->exists()) {
             $messageObj->reply_status = $request->cleadstatus;
            $messageObj->save();
             $responce['active'] = 'no';
        }else {
            $messageObj->reply_status = 3;
            $messageObj->save();
            $responce['active'] = 'yes';
        }

        $responce['leadstatus'] = $messageObj->reply_status;

        if($messageObj->id) {
            echo json_encode($responce);
        }
    }


    /*
    *   Lead Sataus Checker
    */

    public function LeadStatusChecker($id) {
        if($id == 0) {
          return 'Pending';
        }elseif ($id == 1) {
          return 'Replied';
        }elseif ($id == 2) {
          return 'Discarded ';
        }elseif ($id == 3) {
          return 'Booked';
        }
    }


    /*
    *  Lead export for message lead
    */

    public  function export(Request $request) {

       // dd($request->all());

        $fromDate = $request->fromDate;
        $toDate = $request->toDate;

        $myDateTimeF = \DateTime::createFromFormat('d/m/Y', $fromDate);
        $myDateTimeT= \DateTime::createFromFormat('d/m/Y', $toDate);

        $leads = ContactEnquiry::whereBetween('created_at', array($myDateTimeF, $myDateTimeT) )->get()->toArray();

        $exportData = array();
        $i = 0;
        foreach ($leads as $leadsvalue) {
          $datatime = explode(' ', $leadsvalue['created_at']);

          $exportData[$i]['Day'] =  $datatime[0];
          $exportData[$i]['Time'] =  $datatime[1];
          $exportData[$i]['NAME'] =  $leadsvalue['name'];
          $exportData[$i]['TELEPHONE'] = $leadsvalue['phone'];
          $exportData[$i]['E-MAIL'] = $leadsvalue['email'];
          $exportData[$i]['EVENT DATE'] = date('d/m/Y', strtotime($leadsvalue['event_date']));
          $exportData[$i]['COMMENTS'] = strip_tags ($leadsvalue['comment']);
          $exportData[$i]['STATUS'] = $this->LeadStatusChecker($leadsvalue['reply_status']);
          $i++;
        }

        // echo "<pre>";
        // print_r($exportData);
        // die();

        $currentDate = date('d_M_Y');
        \Excel::create('Export_Lead'.$currentDate, function($excel) use ($exportData) {

          $excel->sheet('Excel sheet', function($sheet) use ($exportData) {
              $sheet->setOrientation('landscape');
              $sheet->fromArray($exportData);
          });

        })->export('xlsx');

    }
}
