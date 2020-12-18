<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketSupport;
use App\Mail\TicketSupportNew;
use App\Mail\TicketSupportStatus;
use App\Page;
use App\Admin;
use App\Vendor;
use App\VendorImage;
use App\VendorDeal;
use App\VendorVideo;
use App\VendorFaq;
use App\ReviewRequest;
use Carbon\Carbon;
use App\Ticket;
use App\TicketReplies;
use Session;
use Auth;
use View;

class TicketController extends Controller
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

    public function tickets_opened()
    {
        $dateE = Carbon::now(); 
        $date = Carbon::now(); 
        $dateS = $date->modify("-12 months"); // Last day 12 months ago
        $vendorId = \Auth::user()->vendor_id;
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        //// Advance Filter Query......
        if(isset($_GET['sn']) || isset($_GET['dfrom']) || isset($_GET['dend']) ) {
            $readTicketQuery = Ticket::with('tickets_replies')->where('user_id',$vendorId)->where('status',0);
            if(isset($_GET['sn']) && trim($_GET['sn']) != '' ) {
                $name = $_GET['sn'];
                $readTicketQuery->where(function ($q) use ($name) {
                    $q->where('name','LIKE','%'.$name.'%');
                });
            }
            if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' && isset($_GET['dend']) && $_GET['dend'] != ''  ) {
                $myDateTimeF = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                $myDateTimeE= \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                $dfrom = $myDateTimeF->format('Y-m-d');
                $dend = $myDateTimeE->format('Y-m-d');
                $readTicketQuery->whereBetween('created_at', array($dfrom, $dend));
            } else {
                if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' ) {
                    $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                    $dfrom = $myDateTime->format('Y-m-d');
                    $dend = Carbon::now();
                    $readTicketQuery->whereBetween('created_at', array($dfrom, $dend));
                }
                if( isset($_GET['dend']) && $_GET['dend'] != '' ) {
                    $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                    $dfrom = '1970-01-01';
                    $dend = $myDateTime->format('Y-m-d');
                    $readTicketQuery->whereBetween('created_at', array($dfrom, $dend));
                }
            }
            $readdata = $readTicketQuery->orderBy('id','desc')->paginate(5);
            $data['openTickets'] = $readdata;
        } else {
           $data['openTickets'] = Ticket::with('tickets_replies')->where('user_id',$vendorId)->where('status',0)->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->paginate(5);
        }
        $ticketsCount = $this->ticketsCounter();
        return view('vendor.ticket-support',['data'=>$data, 'ticketsCount'=>$ticketsCount] );
    }

    public function ticketsCounter()
    {
        $dateE = Carbon::now();
        $date = Carbon::now();
        $dateS = $date->modify("-12 months"); // Last day 12 months ago
        $vendorId = \Auth::user()->vendor_id;
        $data['opened'] = Ticket::where("status", 0)->where('user_id',$vendorId)->whereBetween('created_at',array($dateS, $dateE))->count();
        $data['awaiting'] = Ticket::where("status", 1)->where('user_id',$vendorId)->whereBetween('created_at',array($dateS, $dateE))->count();
        $data['closed'] = Ticket::where("status", 2)->where('user_id',$vendorId)->whereBetween('created_at',array($dateS, $dateE))->count();
        $data['customer'] = Ticket::where('subject','customer-service')->where('user_id',$vendorId)->whereBetween('created_at',array($dateS, $dateE))->count();
        $data['sales'] = Ticket::where('subject','sales-support')->where('user_id',$vendorId)->whereBetween('created_at',array($dateS, $dateE))->count();
        $data['technical'] = Ticket::where('subject','technical-support')->where('user_id',$vendorId)->whereBetween('created_at',array($dateS, $dateE))->count();
        return $data;
    }

    public function tickets_awaiting()
    {
        $dateE = Carbon::now(); 
        $date = Carbon::now(); 
        $dateS = $date->modify("-12 months"); // Last day 12 months ago
        $vendorId =  \Auth::user()->vendor_id;
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        //// Advance Filter Query......
        if(isset($_GET['sn']) || isset($_GET['dfrom']) || isset($_GET['dend']) ) {
            $readTicketQuery = Ticket::with('tickets_replies')->where('user_id',$vendorId)->where('status',1);
            if(isset($_GET['sn']) && trim($_GET['sn']) != '' ) {
                $name = $_GET['sn'];
                $readTicketQuery->where(function ($q) use ($name) {
                    $q->where('name','LIKE','%'.$name.'%');
                });
            }
            if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' && isset($_GET['dend']) && $_GET['dend'] != ''  ) {
                $myDateTimeF = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                $myDateTimeE= \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                $dfrom = $myDateTimeF->format('Y-m-d');
                $dend = $myDateTimeE->format('Y-m-d');
                $readTicketQuery->whereBetween('created_at', array($dfrom, $dend));
            } else {
                if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' ) {
                    $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                    $dfrom = $myDateTime->format('Y-m-d');
                    $dend = Carbon::now();
                    $readTicketQuery->whereBetween('created_at', array($dfrom, $dend));
                }
                if( isset($_GET['dend']) && $_GET['dend'] != '' ) {
                    $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                    $dfrom = '1970-01-01';
                    $dend = $myDateTime->format('Y-m-d');
                    $readTicketQuery->whereBetween('created_at', array($dfrom, $dend));
                }
            }
            $readdata = $readTicketQuery->orderBy('id','desc')->paginate(5);
            $data['openTickets'] = $readdata;
        } else {
           $data['openTickets'] = Ticket::with('tickets_replies')->where('user_id',$vendorId)->where('status',1)->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->paginate(5);
        }
        $ticketsCount = $this->ticketsCounter();
        return view('vendor.ticket-support',['data'=>$data, 'ticketsCount'=>$ticketsCount] );
    }

    public function tickets_closed()
    {
        $dateE = Carbon::now(); 
        $date = Carbon::now(); 
        $dateS = $date->modify("-12 months"); // Last day 12 months ago
        $vendorId =  \Auth::user()->vendor_id;
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        //// Advance Filter Query......
        if(isset($_GET['sn']) || isset($_GET['dfrom']) || isset($_GET['dend']) ) {
            $readTicketQuery = Ticket::with('tickets_replies')->where('user_id',$vendorId)->where('status',2);
            if(isset($_GET['sn']) && trim($_GET['sn']) != '' ) {
                $name = $_GET['sn'];
                $readTicketQuery->where(function ($q) use ($name) {
                    $q->where('name','LIKE','%'.$name.'%');
                });
            }
            if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' && isset($_GET['dend']) && $_GET['dend'] != ''  ) {
                $myDateTimeF = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                $myDateTimeE= \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                $dfrom = $myDateTimeF->format('Y-m-d');
                $dend = $myDateTimeE->format('Y-m-d');
                $readTicketQuery->whereBetween('created_at', array($dfrom, $dend));
            } else {
                if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' ) {
                    $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                    $dfrom = $myDateTime->format('Y-m-d');
                    $dend = Carbon::now();
                    $readTicketQuery->whereBetween('created_at', array($dfrom, $dend));
                }
                if( isset($_GET['dend']) && $_GET['dend'] != '' ) {
                    $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                    $dfrom = '1970-01-01';
                    $dend = $myDateTime->format('Y-m-d');
                    $readTicketQuery->whereBetween('created_at', array($dfrom, $dend));
                }
            }
            $readdata = $readTicketQuery->orderBy('id','desc')->paginate(5);
            $data['openTickets'] = $readdata;
        } else {
           $data['openTickets'] = Ticket::with('tickets_replies')->where('user_id',$vendorId)->where('status',2)->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->paginate(5);
        }
        $ticketsCount = $this->ticketsCounter();
        return view('vendor.ticket-support',['data'=>$data, 'ticketsCount'=>$ticketsCount] );
    }

    public function tickets_customer()
    {
        $dateE = Carbon::now(); 
        $date = Carbon::now(); 
        $dateS = $date->modify("-12 months"); // Last day 12 months ago
        $vendorId =  \Auth::user()->vendor_id;
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        //// Advance Filter Query......
        if(isset($_GET['sn']) || isset($_GET['dfrom']) || isset($_GET['dend']) ) {
            $readTicketQuery = Ticket::with('tickets_replies')->where('user_id',$vendorId)->where('subject','customer-service');
            if(isset($_GET['sn']) && trim($_GET['sn']) != '' ) {
                $name = $_GET['sn'];
                $readTicketQuery->where(function ($q) use ($name) {
                    $q->where('name','LIKE','%'.$name.'%');
                });
            }
            if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' && isset($_GET['dend']) && $_GET['dend'] != ''  ) {
                $myDateTimeF = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                $myDateTimeE= \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                $dfrom = $myDateTimeF->format('Y-m-d');
                $dend = $myDateTimeE->format('Y-m-d');
                $readTicketQuery->whereBetween('created_at', array($dfrom, $dend));
            } else {
                if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' ) {
                    $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                    $dfrom = $myDateTime->format('Y-m-d');
                    $dend = Carbon::now();
                    $readTicketQuery->whereBetween('created_at', array($dfrom, $dend));
                }
                if( isset($_GET['dend']) && $_GET['dend'] != '' ) {
                    $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                    $dfrom = '1970-01-01';
                    $dend = $myDateTime->format('Y-m-d');
                    $readTicketQuery->whereBetween('created_at', array($dfrom, $dend));
                }
            }
            $readdata = $readTicketQuery->orderBy('id','desc')->paginate(5);
            $data['openTickets'] = $readdata;
        } else {
           $data['openTickets'] = Ticket::with('tickets_replies')->where('user_id',$vendorId)->where('subject','customer-service')->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->paginate(5);
        }
        $ticketsCount = $this->ticketsCounter();
        return view('vendor.ticket-support',['data'=>$data, 'ticketsCount'=>$ticketsCount] );
    }

    public function tickets_sales()
    {
        $dateE = Carbon::now(); 
        $date = Carbon::now(); 
        $dateS = $date->modify("-12 months"); // Last day 12 months ago
        $vendorId =  \Auth::user()->vendor_id;
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        //// Advance Filter Query......
        if(isset($_GET['sn']) || isset($_GET['dfrom']) || isset($_GET['dend']) ) {
            $readTicketQuery = Ticket::with('tickets_replies')->where('user_id',$vendorId)->where('subject','sales-support');
            if(isset($_GET['sn']) && trim($_GET['sn']) != '' ) {
                $name = $_GET['sn'];
                $readTicketQuery->where(function ($q) use ($name) {
                    $q->where('name','LIKE','%'.$name.'%');
                });
            }
            if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' && isset($_GET['dend']) && $_GET['dend'] != ''  ) {
                $myDateTimeF = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                $myDateTimeE= \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                $dfrom = $myDateTimeF->format('Y-m-d');
                $dend = $myDateTimeE->format('Y-m-d');
                $readTicketQuery->whereBetween('created_at', array($dfrom, $dend));
            } else {
                if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' ) {
                    $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                    $dfrom = $myDateTime->format('Y-m-d');
                    $dend = Carbon::now();
                    $readTicketQuery->whereBetween('created_at', array($dfrom, $dend));
                }
                if( isset($_GET['dend']) && $_GET['dend'] != '' ) {
                    $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                    $dfrom = '1970-01-01';
                    $dend = $myDateTime->format('Y-m-d');
                    $readTicketQuery->whereBetween('created_at', array($dfrom, $dend));
                }
            }
            $readdata = $readTicketQuery->orderBy('id','desc')->paginate(5);
            $data['openTickets'] = $readdata;
        } else {
           $data['openTickets'] = Ticket::with('tickets_replies')->where('user_id',$vendorId)->where('subject','sales-support')->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->paginate(5);
        }
        $ticketsCount = $this->ticketsCounter();
        return view('vendor.ticket-support',['data'=>$data, 'ticketsCount'=>$ticketsCount] );
    }

    public function tickets_technical()
    {
        $dateE = Carbon::now(); 
        $date = Carbon::now(); 
        $dateS = $date->modify("-12 months"); // Last day 12 months ago
        $vendorId =  \Auth::user()->vendor_id;
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['vendorData'] = Vendor::with('company_data','image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        //// Advance Filter Query......
        if(isset($_GET['sn']) || isset($_GET['dfrom']) || isset($_GET['dend']) ) {
            $readTicketQuery = Ticket::with('tickets_replies')->where('user_id',$vendorId)->where('subject','technical-support');
            if(isset($_GET['sn']) && trim($_GET['sn']) != '' ) {
                $name = $_GET['sn'];
                $readTicketQuery->where(function ($q) use ($name) {
                    $q->where('name','LIKE','%'.$name.'%');
                });
            }
            if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' && isset($_GET['dend']) && $_GET['dend'] != ''  ) {
                $myDateTimeF = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                $myDateTimeE= \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                $dfrom = $myDateTimeF->format('Y-m-d');
                $dend = $myDateTimeE->format('Y-m-d');
                $readTicketQuery->whereBetween('created_at', array($dfrom, $dend));
            } else {
                if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' ) {
                    $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dfrom']);
                    $dfrom = $myDateTime->format('Y-m-d');
                    $dend = Carbon::now();
                    $readTicketQuery->whereBetween('created_at', array($dfrom, $dend));
                }
                if( isset($_GET['dend']) && $_GET['dend'] != '' ) {
                    $myDateTime = \DateTime::createFromFormat('d/m/Y', $_GET['dend']);
                    $dfrom = '1970-01-01';
                    $dend = $myDateTime->format('Y-m-d');
                    $readTicketQuery->whereBetween('created_at', array($dfrom, $dend));
                }
            }
            $readdata = $readTicketQuery->orderBy('id','desc')->paginate(5);
            $data['openTickets'] = $readdata;
        } else {
           $data['openTickets'] = Ticket::with('tickets_replies')->where('user_id',$vendorId)->where('subject','technical-support')->whereBetween('created_at', array($dateS, $dateE))->orderBy('id','desc')->paginate(5);
        }
        $ticketsCount = $this->ticketsCounter();
        return view('vendor.ticket-support',['data'=>$data, 'ticketsCount'=>$ticketsCount] );
    }

    public function supports_details($id)
    {
        $vendorId = \Auth::user()->vendor_id;
        $tcktsData = TicketReplies::where('tickets_id',$id)->where('reply_by','!=',$vendorId)->get();
        foreach($tcktsData as $tk) {
            $ticketObjs = TicketReplies::find($tk->id);
            $ticketObjs->is_read = 1;
            $ticketObjs->save();
        }
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['vendorData'] = Vendor::with('company_data','image_data', 'category_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $data['support_details'] = Ticket::with('tickets_replies')->where('id',$id)->first();
        if(empty($data['support_details'])){
            abort('404');
        }
        $data['reply'] = TicketReplies::with('tickets')->where('tickets_id',$id)->orderBy('id','desc')->get()->toArray();
        $ticketsCount = $this->ticketsCounter();
        return view('vendor.supports-details',['data'=>$data, 'ticketsCount'=>$ticketsCount] );
    }

    public function supportsFileupload(Request $request)
    {
        $reponce = array();
        $file = $request->file('fileobj');
        $imgName = str_random(30).'.'.$file->extension();
        $file->move('images/ticket_images',$imgName);
        if($file != "") {
            $reponce['html'] = '<div class="app-admin-sol-template-tag inbox-message-link">
                <span class="icon icon-clip icon-left inbox-message-link__label fleft">'.$file->getClientOriginalName().'</span>
                <a class="icon icon-close-small inbox-message-link__remove app-admin-sol-attached-del" data-imgName='.$imgName.'></a>
            </div>';
            $reponce['imgName'] = $imgName;
        } else {
            $reponce['html'] = '';
            $reponce['imgName'] = '';
        }
        echo json_encode($reponce);
    }

    public function supportsStatusdetails($eqid, $status, $changeby)
    {
        $ticketObj = Ticket::find($eqid);
        $ticketObj->status = $status;
        $ticketObj->save();
        //// Mail Content......
        $vendrData = Vendor::where('vendor_id',$ticketObj->user_id)->first();
        if($ticketObj->subject == 'customer-service' && $vendrData->assign_customer != '') {
            $admins = Admin::where('id',$vendrData->assign_customer)->first();
        }
        if($ticketObj->subject == 'sales-support' && $vendrData->assign_marketing != '') {
            $admins = Admin::where('id',$vendrData->assign_marketing)->first();
        }
        if($ticketObj->subject == 'technical-support' && $vendrData->assign_technical != '') {
            $admins = Admin::where('id',$vendrData->assign_technical)->first();
        }
        if(!isset($admins->email)){
            $admins = Admin::where('id',1)->first();
        }
        // dd($vendrData);
        $vendorEmail = $vendrData->email;
        $vendorLink  = url('supports-details').'/'.$ticketObj->id;
        //// Admin data......
        $adminEmail = $admins->email;
        $adminEmail = 'ashiqkmuhammed@gmail.com';
        $adminLink  = url('admin/ticket-details').'/'.$ticketObj->id;
        if($status == 0) {
            $mStatus = 'Open';
        } elseif($status == 2) {
            $mStatus = 'Closed';
        }
        $mailData['siteLogo'] = url('/')."/public/images/logo.jpg";
        $mailData['ticket_id'] = $ticketObj->ticket_id;
        $mailData['subject'] = $ticketObj->subject;
        $mailData['status'] = $mStatus;
        $mailData['name'] = $vendrData->contact_person;
        $vendorData['redLink'] = $vendorLink;
        $vendorData['othersPage'] = 'tickets_status_vendor';
        $adminData['redLink']  = $adminLink;
        $adminData['othersPage'] = 'tickets_status';
        try {
            Mail::to($vendorEmail)->cc('cesario@indigitalgroup.ca')->send(new TicketSupportStatus($mailData,$vendorData));
            Mail::to($adminEmail)->cc('cesario@indigitalgroup.ca')->send(new TicketSupportStatus($mailData,$adminData));
            if(Mail::failures()) {
                return redirect()->back()->with('error','Something went wrong please try again later.');
            } else {
                if($status == 0) {
                    return \Redirect::back()->with('message','Ticket moved to Opened.');
                }
                if($status == 1) {
                    return \Redirect::back()->with('message','Ticket moved to '.$ticketObj->awaiting_vendor.'.');
                }
                if($status == 2) {
                    return \Redirect::back()->with('message','Ticket moved to Closed.');
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error','Something went wrong please try again later.');
        }
    }

    public function supportsDetailsStatus($eqid, $status)
    {
        $ticketObj = Ticket::find($eqid);
        $ticketObj->is_read = $status;
        $ticketObj->save();
        return $status;
    }

    protected function send_reply_supports(Request $request)
    {
        $vendorId = \Auth::user()->vendor_id;
        $this->validate($request, [
            'comments' => 'required',
        ],[ 'comments.required'=>'Please write something in Message Box.']);
        $attchmnt = '';
        if(@$request->attachment != '') {
            $att1 = explode('--',$request->attachment);
            for($nm = 0; $nm < count($att1); $nm++) {
                if($att1[$nm] != '') {
                    if($attchmnt == '') {
                        $attchmnt = $att1[$nm];
                    } else {
                        $attchmnt .= '--'.$att1[$nm];
                    }
                }
            }
        }
        $tickets = Ticket::find($request->tickets_id);
        $tickets->status = '1';
        $tickets->awaiting_vendor = 'Awaiting support reply';
        $tickets->awaiting_support = 'Awaiting your reply';
        $tickets->save();
        $reObj = new TicketReplies;
        $reObj->tickets_id     = $request->tickets_id;
        $reObj->user_id        = $tickets->user_id;
        $reObj->user_role      = $tickets->user_role;
        $reObj->name           = $tickets->name;
        $reObj->email          = $tickets->email;
        $reObj->subject        = $tickets->subject;
        $reObj->title          = $tickets->title;
        $reObj->comments       = $request->comments;
        if($attchmnt != '') {
            $reObj->attachment = $attchmnt;
        }
        $reObj->reply_by       = $vendorId;
        $reObj->message_type   = 'self';
        $reObj->save();
        //// Ticket Mail sending Start......
        $toEmail = 'cesario@indigitalgroup.ca';
        $vendors = Vendor::where('vendor_id',$vendorId)->first();
        if($tickets->subject == 'customer-service') {
            if(@$vendors->assign_customer) {
                $admins = Admin::where('id',$vendors->assign_customer)->first();
                $toEmail = $admins->email;
            }
        }
        if($tickets->subject == 'sales-support') {
            if(@$vendors->assign_marketing) {
                $admins = Admin::where('id',$vendors->assign_marketing)->first();
                $toEmail = $admins->email;
            }
        }
        if($tickets->subject == 'technical-support') {
            if(@$vendors->assign_technical) {
                $admins = Admin::where('id',$vendors->assign_technical)->first();
                $toEmail = $admins->email;
            }
        }
        $mailData['siteLogo'] = url('/')."/public/images/logo.jpg";
        $mailData['name'] = $tickets->name;
        $mailData['subject'] = $tickets->subject;
        $mailData['title'] = $tickets->title;
        $mailData['message'] = $request->comments;
        $mailData['fileData'] = $attchmnt;
        $mailData['ticket_id'] = $tickets->ticket_id;
        try {
            Mail::to($toEmail)->cc('cesario@indigitalgroup.ca')->send(new TicketSupport($mailData));
            if(Mail::failures()) {
                return redirect()->back()->with('reply', '<div class="alert alert-danger">Something went wrong please try again.</div>');
            } else {
                return redirect()->back()->with('reply', '<div class="alert alert-success">Support Reply Message Sent Successfully.</div>');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('reply', '<div class="alert alert-danger">Something went wrong please try again.</div>');
        }
    }

    public function ticket_support_add()
    {
        $vendorId = \Auth::user()->vendor_id;
        $data['titleData'] = \App\Page::where('id', 10)->first();
        $data['vendorData'] = Vendor::with('company_data','image_data', 'category_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        return view('vendor.ticket_support_add',['data'=>$data]);
    }

    public function sendNewSupport(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required',
            'priority' => 'required',
            'title' => 'required',
            'comments' => 'required',
        ],[ 'subject.required' => 'Please select category type.',
            'priority.required' => 'Please choose priority type.',
            'title.required' => 'Ticket Subject is required.',
            'comments.required' => 'Please write something in Message Box.']);
        $attchmnt = '';
        if(@$request->attachment != '') {
            $att1 = explode('--',$request->attachment);
            for($nm = 0; $nm < count($att1); $nm++) {
                if($att1[$nm] != '') {
                    if($attchmnt == '') {
                        $attchmnt = $att1[$nm];
                    } else {
                        $attchmnt .= '--'.$att1[$nm];
                    }
                }
            }
        }
        $vendorId = \Auth::user()->vendor_id;
        $vendors = Vendor::where('vendor_id',$vendorId)->first();
        $reObj = new Ticket;
        $reObj->name           = $vendors->contact_person;
        $reObj->email          = $vendors->email;
        $reObj->subject        = $request->subject;
        $reObj->title          = $request->title;
        $reObj->rate_id        = $request->rateId;
        $reObj->comments       = $request->comments;
        if($attchmnt != '') {
            $reObj->attachment = $attchmnt;
        }
        $reObj->priority       = $request->priority;
        $reObj->user_id        = $vendorId;
        $reObj->user_role      = 'vendor';
        $reObj->save();
        //// Ticket Mail sending Start......
        $toEmail = 'cesario@indigitalgroup.ca';
        if($request->subject == 'customer-service') {
            if(@$vendors->assign_customer) {
                $admins = Admin::where('id',$vendors->assign_customer)->first();
                $toEmail = $admins->email;
            }
        }
        if($request->subject == 'sales-support') {
            if(@$vendors->assign_marketing) {
                $admins = Admin::where('id',$vendors->assign_marketing)->first();
                $toEmail = $admins->email;
            }
        }
        if($request->subject == 'technical-support') {
            if(@$vendors->assign_technical) {
                $admins = Admin::where('id',$vendors->assign_technical)->first();
                $toEmail = $admins->email;
            }
        }
        $mailData['siteLogo'] = url('/')."/public/images/logo.jpg";
        $mailData['name'] = $vendors->contact_person;
        $mailData['subject'] = $request->subject;
        $mailData['title'] = $request->title;
        $mailData['message'] = $request->comments;
        $mailData['fileData'] = $attchmnt;
        $mailData['ticket_id'] = 'Ticket #'.(999 + $reObj->id);
        try {
            Mail::to($vendors->email)->cc('cesario@indigitalgroup.ca')->send(new TicketSupportNew($mailData));
            Mail::to($toEmail)->cc('cesario@indigitalgroup.ca')->send(new TicketSupport($mailData));
            if(Mail::failures()) {
                return redirect()->back()->with('reply', '<div class="alert alert-danger">Something went wrong please try again.</div>');
            } else {
                $reObj->ticket_id = 'Ticket #'.(999 + $reObj->id);
                $reObj->save();
                return redirect()->back()->with('reply', '<div class="alert alert-success">Your request has been successfully sent.</div>');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('reply', '<div class="alert alert-danger">Something went wrong please try again.</div>');
        }
    }
}