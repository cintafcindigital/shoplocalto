<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use View;
use Session;
use App\Admin;
use App\Vendor;
use App\User;
use App\Countries;
use App\UserBookedVendor;
use App\VendorRating;
use App\UserAddedVendor;
use App\ContactEnquiry;
use App\weddingWebsite;
use App\Ticket;
use App\TicketReplies;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketSupport;
use App\Mail\TicketSupportStatus;

class AdminTicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $data['new_users'] = User::whereDate('created_at', DB::raw('CURDATE()'))->count();
        $data['new_vendors'] = Vendor::whereDate('created_at', DB::raw('CURDATE()'))->count();
        View::share('slideBar',$data);
    }

    public function new_tickets(Request $request)
    {
        $staffRole = @Session::get('adminData')[0]['role'];
        $name = $request->name;
        $subject = $request->subject;
        if($name != null && $name != '') {
            $query = Ticket::where('name','LIKE','%'.$name.'%')->orWhere('email','LIKE','%'.$name.'%')->orderBy('created_at','DESC');
        } else {
            $query = Ticket::orderBy('created_at','DESC');
        }
        if($subject != null && $subject != '') {
            $query->where('subject',$subject);
        }
        $tickets = $query->where('status',0)->get();
        return view('admin/vendors/new-tickets', ['tickets' => $tickets]);
    }

    public function pending_tickets(Request $request)
    {
        $staffRole = @Session::get('adminData')[0]['role'];
        $name = $request->name;
        $subject = $request->subject;
        if($name != null && $name != '') {
            $query = Ticket::where('name','LIKE','%'.$name.'%')->orWhere('email','LIKE','%'.$name.'%')->orderBy('created_at','DESC');
        } else {
            $query = Ticket::orderBy('created_at','DESC');
        }
        if($subject != null && $subject != '') {
            $query->where('subject',$subject);
        }
        $tickets = $query->where('status',1)->get();
        return view('admin/vendors/pending-tickets', ['tickets' => $tickets]);
    }

    public function closed_tickets(Request $request)
    {
        $staffRole = @Session::get('adminData')[0]['role'];
        $name = $request->name;
        $subject = $request->subject;
        if($name != null && $name != '') {
            $query = Ticket::where('name','LIKE','%'.$name.'%')->orWhere('email','LIKE','%'.$name.'%')->orderBy('created_at','DESC');
        } else {
            $query = Ticket::orderBy('created_at','DESC');
        }
        if($subject != null && $subject != '') {
            $query->where('subject',$subject);
        }
        $tickets = $query->where('status',2)->get();
        return view('admin/vendors/closed-tickets', ['tickets' => $tickets]);
    }

    public function ticket_details($id)
    {
        $staffId = @Session::get('adminData')[0]['id'];
        $ticketObj = Ticket::find($id);
        $ticketObj->is_read = 1;
        $ticketObj->save();
        $tcktsData = TicketReplies::where('tickets_id',$id)->where('reply_by','!=',$staffId)->get();
        foreach($tcktsData as $tk) {
            $ticketObjs = TicketReplies::find($tk->id);
            $ticketObjs->is_read = 1;
            $ticketObjs->save();
        }
        $tickets = Ticket::with(['tickets_replies'=>function($q) use($id){
                $q->where('tickets_id',$id)->orderBy('created_at','DESC');
            }])->where('id',$id)->first();
        $ratingData = VendorRating::where('id',$tickets->rate_id)->first();
        return view('admin/vendors/ticket-details', ['tickets' => $tickets,'ratingData' => $ratingData]);
    }
    
    public function dispute_review_status($id,$status)
    {
        $rate = VendorRating::find($id);
        $rate->dispute_status = $status;
        $status = $rate->save();
        return $status ? redirect()->back()->with('message', 'Successfully changed review status !!') : redirect()->back()->with('error', 'Something went wrong please try again');
    }

    public function replyFileupload(Request $request)
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

    protected function send_reply_admin(Request $request)
    {
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
        $staffId = @Session::get('adminData')[0]['id'];
        $tickets = Ticket::find($request->tickets_id);
        $tickets->status = '1';
        $tickets->awaiting_vendor = 'Awaiting your reply';
        $tickets->awaiting_support = 'Awaiting vendor reply';
        $tickets->save();
        $reObj = new TicketReplies;
        $reObj->tickets_id     = $request->tickets_id;
        $reObj->user_id        = $tickets->user_id;
        $reObj->user_role      = $tickets->user_role;
        $reObj->name           = @Session::get('adminData')[0]['name'];
        $reObj->email          = @Session::get('adminData')[0]['email'];
        $reObj->subject        = $tickets->subject;
        $reObj->title          = $tickets->title;
        $reObj->comments       = $request->comments;
        if($attchmnt != '') {
            $reObj->attachment = $attchmnt;
        }
        $reObj->reply_by       = $staffId;
        $reObj->message_type   = 'reply';
        $reObj->save();

        //// Ticket Mail sending Start......
        $toEmail = 'cesario@indigitalgroup.ca';
        $vendors = Vendor::where('vendor_id',$tickets->user_id)->first();
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
        $mailData['name'] = @Session::get('adminData')[0]['name'];
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
                return redirect()->back()->with('reply', '<div class="alert alert-success">Reply Message Sent Successfully.</div>');
            }
        } catch (\Exception $e) {
                return redirect()->back()->with('reply', '<div class="alert alert-danger">Something went wrong please try again.</div>');
        }
    }

    public function supportsStatusdetails($eqid, $status, $changeby)
    {
        $ticketObj = Ticket::find($eqid);
        $ticketObj->status = $status;
        $ticketObj->save();
        //// Mail Content......
        $vendorEmail = $ticketObj->email;
        $vendorLink  = url('supports-details').'/'.$ticketObj->id;
        //// Admin data......
        $admins = Admin::where('id',$changeby)->first();
        $adminEmail = $admins->email;
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
        $mailData['name'] = 'Staff Member';
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
}