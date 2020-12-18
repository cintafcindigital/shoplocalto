<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserChangePassword;
use App\Mail\UserVerifyLink;
use App\Mail\EnquiryReply;
use App\Mail\UserEnquiryReply;
use App\User;
use App\UserPartners;
use App\VendorCompany;
use App\Category;
use App\CategoryImages;
use App\TodoListCategory;
use App\TodoListDate;
use App\TodoList;
use App\TodoAnswerList;
use App\UserAddedVendor;
use App\UserBookedVendor;
use App\VendorsForTask;
use App\Page;
use App\Vendor;
use App\GuestsList; //// old table
use App\GuestsListNew;
use App\GuestsInvitationEvents;
use App\GuestsEvent;
use App\GuestsCategory;
use App\userBudget;
use App\SeatingChart;
use App\SeatingChartlist;
use App\SeatArrangement;
use App\ContactEnquiry;
use App\EnquiryReplyimage;
use App\weddingWebsite;
use App\CommunityDiscussion;
use App\userTotalEstimateBudget;
use DB;
use PDF;
use Auth;
use View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $bride_todo_total;
    public $bride_todo_pending;
    public $bride_todo_complete;
    public $bride_todo_percent;
    public $toDoTabFirst;
    public $toDoTabSecond;
    public $toDoTabThird;
    public $toDoTabFourth;
    public $toDoTabFifth;
    public $toDoTabSixth;
    public $toDoTabSeventh;
    public function __construct()
    {
        $this->middleware('auth');
        $userId = @\Auth::user()->id;
        $listedTasks = TodoList::select('id as list_id','title','description','todo_date_id','todo_cat_id','status as task_status')
                                ->where('user_id','=','0')->orWhere('user_id',$userId)->get()->toArray();
        $answerTasks = TodoAnswerList::select('list_id','title','description','todo_date_id','todo_cat_id','task_status')
                                ->where('user_id',$userId)->get()->toArray();
        if(isset($listedTasks) && !empty($listedTasks)) {
            $answerTaskIds = array();
            if(isset($answerTasks) && !empty($answerTasks)) {
                $answerTaskIds = array_column($answerTasks,'list_id');
                foreach($listedTasks as &$vval) {
                    if(in_array($vval['list_id'],$answerTaskIds)) {
                       $key = array_search($vval['list_id'], $answerTaskIds);
                       $vval['task_status'] = $answerTasks[$key]['task_status'];
                    }
                }
            }
        }
        $totalCounter = $pendingCount = $completeCount = 0;
        if(isset($listedTasks) && !empty($listedTasks)) {
            foreach($listedTasks as $nm => $task) {
                if($task['task_status'] != 3) {
                    $totalCounter += 1;
                    if($task['task_status'] == 1) { $pendingCount += 1; }
                    if($task['task_status'] == 2) { $completeCount += 1; }
                }
            }
        }
        $this->bride_todo_total = $totalCounter;
        $this->bride_todo_pending = $pendingCount;
        $this->bride_todo_complete = $completeCount;
        if($totalCounter != 0) {
            $this->bride_todo_percent = round(($completeCount * 100) / $totalCounter);
        } else {
            $this->bride_todo_percent = 0;
        }
        $this->toDoTabFirst = $this->toDoTabSecond = $this->toDoTabThird = $this->toDoTabFourth = $this->toDoTabFifth = $this->toDoTabSixth = $this->toDoTabSeventh = '0';
        if($userId) {
            $userBookedVendor = UserBookedVendor::where('user_id',$userId)->where('book_status','6')->count();
            if($userBookedVendor) {
                $this->toDoTabSixth = '1';
            }
            $communityDiscussion = CommunityDiscussion::where('user_id',$userId)->count();
            if($communityDiscussion) {
                $this->toDoTabSeventh = '1';
            }
            $todoAnswerList = TodoAnswerList::where('user_id',$userId)->where('task_status','2')->get();
            foreach($todoAnswerList as $tdsVal) {
                if($tdsVal->list_id == 1) { $this->toDoTabFirst = '1'; }
                if($tdsVal->list_id == 3) { $this->toDoTabSecond = '1'; }
                if($tdsVal->list_id == 48) { $this->toDoTabThird = '1'; }
                if($tdsVal->list_id == 4) { $this->toDoTabFourth = '1'; }
                if($tdsVal->list_id == 7) { $this->toDoTabFifth = '1'; }
            }
        }
        View::share ( 'bride_todo_total', $this->bride_todo_total);
        View::share ( 'bride_todo_pending', $this->bride_todo_pending);
        View::share ( 'bride_todo_complete', $this->bride_todo_complete);
        View::share ( 'bride_todo_percent', $this->bride_todo_percent);
        View::share ( 'toDoTabFirst', $this->toDoTabFirst);
        View::share ( 'toDoTabSecond', $this->toDoTabSecond);
        View::share ( 'toDoTabThird', $this->toDoTabThird);
        View::share ( 'toDoTabFourth', $this->toDoTabFourth);
        View::share ( 'toDoTabFifth', $this->toDoTabFifth);
        View::share ( 'toDoTabSixth', $this->toDoTabSixth);
        View::share ( 'toDoTabSeventh', $this->toDoTabSeventh);
    }

    /*
    * Debug function
    *
    */
    public function debug($data){
        echo"<pre>"; print_r($data); die;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($showPopup=null)
    {
        $userId = \Auth::user()->id;
        $guestsEventCount = GuestsEvent::where('user_id',$userId)->count();
        if($guestsEventCount == 0) {
            return $this->createGuestsEvent();
        }
        $guestsCategoryCount = GuestsCategory::where('user_id',$userId)->where('status','1')->count();
        if($guestsCategoryCount == 0) {
            return $this->createGuestsCategory();
        }
        $showPlanner = 0;
        $proImagePath = $this->get_profile_img();
        $user_partner = UserPartners::select('*',DB::raw("concat(partner_firstname,' ',partner_lastname) AS partner_name"))->where('user_id',$userId)->get()->toArray();
        $data = $this->getBookedVendor($userId);
        $parentCount = Category::where([['id','!=',2],['id','!=',39],['status','=',1],['is_parent','=',1]])->count();
        $data['totalCats'] = Category::where([['parent_id','=',2],['status','=',1]])->count();
        $data['totalCats'] = $data['totalCats'] + $parentCount;  // Add For (Venues) / (Groom) / (Bride) Category
        $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','39')->first();
        $data['listData'] = $this->getUserLists();
        $data['guest_list'] = GuestsListNew::leftJoin('guests_invitation_events as GI','GI.guest_id','=','guests_lists_new.id')
                        ->with('getGroup')->where('user_id',$userId)->where('GI.attendances','pending')->limit(3)->get()->toArray();
        $guestData = GuestsList::where('user_id','=',$userId)->get()->toArray();
        $data['total_guests'] = count($guestData);
        $data['guests'] = array_count_values(array_column($guestData,'attendance'));
        $page['hot_deals'] = Page::get_hot_deals();
        $data['websitedata'] = weddingWebsite::where('user_id', $userId)->get()->toArray();
        ////////////////////////////////////////////
        $data['total_estimate'] = $data['total_final_cost'] = 0;
        $budgets = userBudget::where([['user_id','=',$userId]])->get()->toArray();
        if(isset($budgets) && !empty($budgets)){
            $data['total_estimate'] = number_format(array_sum(array_column($budgets,'estimate_budget')));
            $data['total_final_cost'] = number_format(array_sum(array_column($budgets,'final_cost')));
        }
        if($showPopup){
            $showPlanner = 1;
        }
        $data['discusstion'] = CommunityDiscussion::with(['userinfo'])->orderBy('created_at', 'desc')->take(3)->get();
        $data['vendor'] = Vendor::with('company_data','category_data')->get()->toArray();
        $vendorsearch = array();
        $i = 0;
        /*foreach ($data['vendor'] as $vendordata) {
            if(!empty($vendordata['company_data']['business_name'])) {
                $vendorsearch[$i]['key'] = $vendordata['vendor_id'];
                $vendorsearch[$i]['value'] = $vendordata['company_data']['business_name'].' '.$vendordata['category_data']['title'].','.$vendordata['company_data']['country'];
                $i++;
            }
        }*/
        $data['vendorSearch'] = $vendorsearch;
        $data['catImages'] = CategoryImages::get();
        ////////////////////////////////////////////
        // print_r($user_partner);
        return view('tools.home',['showPlanner'=>$showPlanner,'pro_image'=>$proImagePath,'user_partner'=>$user_partner,'data'=>$data,'pageData'=>$page]);
    }

    public function createGuestsEvent()
    {
        $eName = '';
        $showPopup = '';
        $userId = \Auth::user()->id;
        for($gem = 0; $gem < 3; $gem++) {
            if($gem == 0) {
                $eName = 'Wedding';
            } elseif($gem == 1) {
                $eName = 'Rehearsal Dinner';
            } elseif($gem == 2) {
                $eName = 'Shower';
            }
            $gstEvnt = new GuestsEvent;
            $gstEvnt->user_id = $userId;
            $gstEvnt->event_name = $eName;
            $gstEvnt->tables = 'No';
            $gstEvnt->menus = 'No';
            $gstEvnt->menu_types = NULL;
            $gstEvnt->lists = 'Yes';
            $gstEvnt->list_types = 'A-List--B-List--C-List';
            $gstEvnt->is_default = '1';
            $gstEvnt->save();
        }
        return $this->index($showPopup);
    }

    public function createGuestsCategory()
    {
        $cName = $isDeflt = $showPopup = '';
        $userId = \Auth::user()->id;
        $user_partner = UserPartners::where('user_id',$userId)->first();
        for($gcm = 0; $gcm < 8; $gcm++) {
            $yfname = explode(' ',$user_partner->name);
            $pfname = explode(' ',$user_partner->partner_name);
            if($gcm == 0) {
                $isDeflt = '0'; $cName = 'Couple';
            } elseif($gcm == 1) {
                $isDeflt = '1'; $cName = $yfname[0]."'s Family";
            } elseif($gcm == 2) {
                $isDeflt = '1'; $cName = $pfname[0]."'s Family";
            } elseif($gcm == 3) {
                $isDeflt = '1'; $cName = $yfname[0]."'s Colleagues";
            } elseif($gcm == 4) {
                $isDeflt = '1'; $cName = $pfname[0]."'s Colleagues";
            } elseif($gcm == 5) {
                $isDeflt = '1'; $cName = $yfname[0]."'s Friends";
            } elseif($gcm == 6) {
                $isDeflt = '1'; $cName = $pfname[0]."'s Friends";
            } elseif($gcm == 7) {
                $isDeflt = '1'; $cName = 'Mutual Friends';
            }
            $gstCat = new GuestsCategory;
            $gstCat->user_id = $userId;
            $gstCat->title = $cName;
            $gstCat->is_default = $isDeflt;
            $gstCat->status = '1';
            $gstCat->save();
        }
        return $this->index($showPopup);
    }

    /**
     * Show the user setting page.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_settings()
    {
        $userId =  \Auth::user()->id;
        $data['userData'] = \Auth::user();
        $data['profile_image'] = $this->get_profile_img();
        $countries = \App\Countries::where('status',1)->get()->toArray();
        $data['titleData'] = \App\Page::where('id', 14)->first();
        return view('tools.user_setting',['data'=>$data,'countries'=>$countries]);
    }

    /**
     * Save the user setting page.
     *
     * @return \Illuminate\Http\Response
     */
    public function save_user_settings(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'address' => 'required',
            'country' => 'required',
        ]);
        $userId =  \Auth::user()->id;
        $userObj = User::find($userId);
        $userObj->name = $request->input('name');
        $userObj->address = $request->input('address');
        $userObj->country = $request->input('country');
        $userObj->phone = $request->input('phone');
        $response = $userObj->save();
        if($response){
            return redirect()->back()->with('success','Profile Updated Successfully.');
        }else{
            return redirect()->back()->with('error','Something went wrong! Please try again.');
        }
    }

    /**
    * Save the account setting page.
    *
    * @return \Illuminate\Http\Response
    */
    public function save_account_settings(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:6|same:password',
            'password_confirmation' => 'required|min:6|same:password',
        ]);
        $current_password = \Auth::User()->password;           
        if(\Hash::check($request->input('current_password'), $current_password))
        {           
            $userId =  \Auth::user()->id;
            $emailAddress =  \Auth::user()->email;
            $sendData['name'] =  \Auth::user()->name;
            $userObj = User::find($userId);
            $userObj->password = bcrypt($request->input('password'));
            $response = $userObj->save();
            if($response){
                try {
                   Mail::to($emailAddress)->send(new UserChangePassword($sendData));
                } catch (\Exception $e) {}
               return redirect()->back()->with('success','Password Updated Successfully.');
            }else{
               return redirect()->back()->with('error','Something went wrong! Please try again.');
            }
        } else {           
           return redirect()->back()->with('error','Please enter correct current password.'); 
        }
    }

    /**
     * Show the account setting page.
     *
     * @return \Illuminate\Http\Response
     */
    public function account_settings() {
        $data['titleData'] = \App\Page::where('id', 15)->first();
        return view('tools.account_setting',['data'=>$data]);
    }

    public function getBookedVendor($userId)
    {
        $vendorCatsData = Category::select('id','title')->where([['parent_id','=',2],['status','=',1]])->limit(5)->get()->toArray();
        $bookData = UserBookedVendor::select('user_booked_vendors.*','V.cat_id','VC.business_name',
            DB::raw('(select concat(vendor_folder,"/",image) from vendor_images where vendor_images.vendor_id = V.vendor_id limit 1) as image'))
        ->leftJoin('vendors as V','user_booked_vendors.vendor_id','=','V.vendor_id')
        ->leftJoin('vendor_companies as VC','V.vendor_id','=','VC.vendor_id')
        ->where('user_booked_vendors.user_id','=',$userId)
        ->where('user_booked_vendors.book_status','=',6)
        ->groupBy('V.cat_id')->get()->toArray();
        if(isset($vendorCatsData) && !empty($vendorCatsData)) {
            foreach($vendorCatsData as $key=>$cVal) {
                if(count($bookData) == 0){ break; }
                $keyVal = array_search($cVal['id'],array_column($bookData,'cat_id'));
                if($keyVal !== false){
                    $vendorCatsData[$key]['booked'] = $bookData[$keyVal];
                }
            }
        }
        $returnData['vendorCats'] = $vendorCatsData;
        $returnData['booked_vendors'] = count($bookData);
        return $returnData;
    }

    public function send_verify_link(){
        $isVerify =  \Auth::user()->verify;
        if(!$isVerify){
          echo "Send Mail";die;
        } else {
          return redirect()->back()->with('error','Your account already verified. Please ignore this process.');  
        }
    }

    /*
    *
    *   Export chart PDF
    *
    */
    public function get_chart_PDF()
    {
        $userId =  \Auth::user()->id;
        $tableChart = SeatingChart::with('seatdata')->where('user_id', $userId)->get();
        $currenUserGeust = $guestData = GuestsList::where('user_id','=',$userId)->get()->toArray();
        $charHeightWidth = SeatingChartlist::where('user_id','=',$userId)->get()->toArray();
        $pdfImage = url('public/images/logo.png');
        $pdf = PDF::loadView('tools.seatingchart_PDF',compact('tableChart', 'currenUserGeust', 'pdfImage'));
        $pdfheight = $charHeightWidth[0]['tbl_height'];
        $pdfwidth = $charHeightWidth[0]['tbl_width'];
        //$customPaper = array(0,0,$pdfheight,$pdfwidth); // For daynamic paper
        $customPaper = array(0,0,950,1500);
        $pdf->setPaper($customPaper);
        //return $pdf->stream();  // View for browser
        return $pdf->download('seatingchart_PDF.pdf');  // Download on browser
        //return view('tools.seatingchart_PDF',compact('tableChart', 'currenUserGeust', 'pdfImage')); // View for HTML
    }

    /*
    *
    *   Export chart list PDF
    *
    */
    public function get_chartList_PDF()
    {
        $userId =  \Auth::user()->id;
        $tableUserlist = SeatingChart::with('seatdata')->where('user_id', $userId)->orderBy('positions', 'ASC')->get();
        $tableSeatlistarray = array();
        $i = 0;
        foreach ($tableUserlist as $key => $tableuserlistValue) {
            if($tableuserlistValue->table_type != 'noSeats') {
                $tableSeatlistarray[$i]['tableID'] = $tableuserlistValue->id;
                $tableSeatlistarray[$i]['userID'] = $tableuserlistValue->user_id;
                $tableSeatlistarray[$i]['tblname'] = $tableuserlistValue->table_nm;
                $tableSeatlistarray[$i]['table_type'] = $tableuserlistValue->table_type;
                $j = 0;
                    foreach($tableuserlistValue->seatdata as $gustdata) {
                        $gustData = GuestsList::where('id', '=', $gustdata->gust_id)->get();
                        $tableSeatlistarray[$i]['gustdata'][$j]['gustid'] = $gustData[0]->id;
                        $tableSeatlistarray[$i]['gustdata'][$j]['gustname'] = $gustData[0]->name;
                        $tableSeatlistarray[$i]['gustdata'][$j]['seat_id'] = $gustdata->seat_id;
                        $j++;
                    }
                $i++;
            }
        }
        $listData = json_encode($tableSeatlistarray);
        $pdfImage = url('public/images/logo.png');
        $pdf = PDF::loadView('tools.seating_listPDF',compact('listData','pdfImage'));
        // $customPaper = array(0,0,950,1500);
        // $pdf->setPaper($customPaper);
        //return $pdf->stream();  // View for browser
        return $pdf->download('seatingList_PDF.pdf');  // Download on browser
        //return view('tools.seating_listPDF', array('listData'=> $listData, 'pdfImage' => $pdfImage));
    }

    /*
    *
    *   Export Sample list for Guest (.xlsx)
    *
    */
    public function GuestsCSV_export()
    {
        $currentDate = date('d_M_Y');
        \Excel::create('Guest_List_Demo'.$currentDate, function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {
                $guestList = array( 'NAME', 'LAST NAME', 'E-MAIL', 'TELEPHONE NUMBER', 'MOBILE NUMBER', 'POSTAL CODE' );
                $sheet->setOrientation('landscape');
                $sheet->fromArray($guestList);
            });
        })->export('xlsx');
    }

    /*
    *
    * Guest Import (.xlsx) File
    *
    */
    public function guestsimportCSV(Request $request)
    {
        ////dd($request->file('spreadsheet'));
        // $response = array();
        // $path = $request->file('spreadsheet')->getRealPath();
        // $data = \Excel::load($path)->get();
        // if($data->count()){
        //     foreach ($data as $key => $value) {
        //         $userId =  \Auth::user()->id;
        //         $guestObj = new GuestsList;
        //         $guestObj->user_id = $userId;
        //         $guestObj->name = $value->firstname.' '.$value->lastname;
        //         $guestObj->attendance = 'pending';
        //         $guestObj->menu = 'no menu assigned';
        //         $guestObj->age_type = 'Not defined';
        //         $guestObj->group_id = 10;
        //         $guestObj->email = $value->e_mail;
        //         $guestObj->phone = $value->telephone_number;
        //         $guestObj->mobile = $value->mobile_number;
        //         $guestObj->city = $request->input('city');
        //         $guestObj->country = 'CA';
        //         $guestObj->postal_code = $value->postal_code;
        //         $savD = $guestObj->save();
        //     }
        //     $response['success'] = 'File Imported successfully.';
        // } else {
        //     $response['error'] = 'Something went wrong..';
        // }
        // return json_encode($response);
    }

    /**
     * Show the seating List.
     *
     * @return \Illuminate\Http\Response
    */
    public function seating_list(Request $request)
    {
        $userId = \Auth::user()->id;
        $idEvent = @$request->idEvent;
        $tableUserlist = SeatingChart::with('seatdata')->where('user_id',$userId)->where('event_id',$idEvent)->orderBy('positions','ASC')->get();
        $tableSeatlistarray = array();
        $i = 0;
        foreach ($tableUserlist as $key => $tableuserlistValue) {
            if($tableuserlistValue->table_type != 'noSeats') {
                $tableSeatlistarray[$i]['tableID'] = $tableuserlistValue->id;
                $tableSeatlistarray[$i]['userID'] = $tableuserlistValue->user_id;
                $tableSeatlistarray[$i]['tblname'] = $tableuserlistValue->table_nm;
                $tableSeatlistarray[$i]['table_type'] = $tableuserlistValue->table_type;
                $j = 0;
                foreach($tableuserlistValue->seatdata as $gustdata) {
                    $gustData = GuestsListNew::where('id', '=', $gustdata->gust_id)->first();
                    $seatData = SeatArrangement::where('user_id',$userId)->where('event_id',$idEvent)->where('gust_id',$gustdata->gust_id)->first();
                    $tableSeatlistarray[$i]['gustdata'][$j]['gustid'] = $gustData->id;
                    $tableSeatlistarray[$i]['gustdata'][$j]['gustname'] = $gustData->firstname.' '.$gustData->lastname;
                    $tableSeatlistarray[$i]['gustdata'][$j]['seat_id'] = $seatData->seat_id;
                    $j++;
                }
                $i++;
            }
        }
        $listData = json_encode($tableSeatlistarray);
        $guestsEvent = GuestsEvent::where('user_id',$userId)->where('tables','Yes')->get();
        return view('tools.seating_list', array('listData'=> $listData, 'guestsEvent' => $guestsEvent));
    }

    /**
    * Show the seating list positions.
    *
    * @return \Illuminate\Http\Response
    */
    public function seating_list_position( Request $request)
    {
        // dd($request->all());
        foreach ($request->position as $key => $positionValue) {
            $dataKeyval = explode('=', $positionValue);
            $positionSave = SeatingChart::find($dataKeyval[0]);
            $positionSave->positions = $dataKeyval[1];
            $positionSave->save();
        }
    }

    /*
    *
    * Get chart Grid positions
    *
    */
    public function get_chartGrid()
    {
        $userId = \Auth::user()->id;
        $response = array();
        if (!SeatingChart::where('user_id', '=', $userId)->exists()) {
            $response['postionY'] = 0;
            $response['postionX'] = 0;
            return json_encode($response);
        }
        $maxX = SeatingChart::where('user_id', '=', $userId)->max('posX');
        $maxY = SeatingChart::where('user_id', '=', $userId)->max('posY');
        $tableWidthX = SeatingChart::select('table_width')->where('posX', $maxX)->get()->toArray();
        $tableWidthY = SeatingChart::select('table_width')->where('posY', $maxY)->get()->toArray();
        $tableWidthsum = SeatingChart::where('user_id', '=', $userId)->sum('table_width');
        if($tableWidthsum < 800 ) {
            $response['postionY'] = 0;
            $response['postionX'] = $tableWidthsum + 100;
        } else {
            $response['postionY'] = 200;
            $response['postionX'] = 400;
        }
        return json_encode($response);
    }

    /**
    *
    * Replace value Array
    *
    */
    public function changeValuearray($groupNewArr, $user_partner)
    {
        $userArray = array();
        $userArray[0]['name'] =  explode(' ', $user_partner[0]['name'])[0];
        $userArray[0]['gender'] = $user_partner[0]['gender'];
        if($user_partner[0]['partner_name'] != '') {
            $userArray[1]['name'] = explode(' ', $user_partner[0]['partner_name'])[0];
        }
        $userArray[1]['gender'] =  $user_partner[0]['partner_gender'];
        foreach ($groupNewArr as $keys => $groupVal) 
        {
            if($groupVal['id'] == 1 || $groupVal['id'] == 2 || $groupVal['id'] == 9 || $groupVal['id'] == 10) { continue; }
            foreach ($userArray as $key => $uservalue) {
                $titleArray = explode(' ', $groupVal['title']);
                if($uservalue['gender'] == 'bride' && $titleArray[0] == 'Bride' ) {
                    $groupNewArr[$keys]['title'] = $uservalue['name'].' '.$titleArray[1];
                }
                if($uservalue['gender'] == 'groom' && $titleArray[0] == 'Groom' ) {
                    $groupNewArr[$keys]['title'] = $uservalue['name'].' '.$titleArray[1];
                }
            }
        }
        return $groupNewArr;
    }

    /**
     * Show the seating page.
     *
     * @return \Illuminate\Http\Response
     */
    public function seating_chart(Request $request)
    {
        $userId =  \Auth::user()->id;
        if (!SeatingChartlist::where('user_id', '=', $userId)->exists()) {
            $seatingChartlist = new SeatingChartlist;
            $seatingChartlist->user_id  = $userId;
            $seatingChartlist->table_name = 'ChartTable_'.$userId;
            $seatingChartlist->tbl_height = 450;
            $seatingChartlist->tbl_width = 450;
            $seatingChartlist->save();
        }
        $idEvent = @$request->idEvent;
        $data['chartablelist'] = SeatingChartlist::where('user_id', '=', $userId)->get();
        if($idEvent) {
            $data['unassignListData'] = GuestsListNew::leftJoin('guests_invitation_events as GI','GI.guest_id','=','guests_lists_new.id')
                            ->leftJoin('seat_arrangements as SA','SA.gust_id','=','guests_lists_new.id')
                            ->select('guests_lists_new.id as guestId','guests_lists_new.group_id','guests_lists_new.firstname','guests_lists_new.lastname','guests_lists_new.age_type','guests_lists_new.gender','SA.seat_id','SA.event_id')
                            ->where('guests_lists_new.group_id',NULL)->where('GI.invited_for',$idEvent)->get();
            $data['guestListData'] = GuestsCategory::where('user_id',$userId)->where('status','1')->get();
            foreach($data['guestListData'] as $nm => $vls) {
                $guestsData = GuestsListNew::leftJoin('guests_invitation_events as GI','GI.guest_id','=','guests_lists_new.id')
                            ->leftJoin('seat_arrangements as SA','SA.gust_id','=','guests_lists_new.id')
                            ->select('guests_lists_new.id as guestId','guests_lists_new.group_id','guests_lists_new.firstname','guests_lists_new.lastname','guests_lists_new.age_type','guests_lists_new.gender','SA.seat_id','SA.event_id')
                            ->where('guests_lists_new.group_id',$vls->id)->where('GI.invited_for',$idEvent)->get();
                $data['guestListData'][$nm]['guestsData'] = $guestsData;
            }
            $data['tableChart'] = SeatingChart::with('seatdata')->where('user_id', $userId)->where('event_id', $idEvent)->get();
        } else {
            $data['unassignListData'] = array();
            $data['guestListData'] = array();
            $data['tableChart'] = SeatingChart::with('seatdata')->where('user_id', $userId)->get();
        }
        // echo "<pre>"; print_r($data['guestListData']); die;
        // $data['guestsCat'] = \App\GuestsCategory::where('user_id',$userId)->where('status','=','1')->get()->toArray();
        $data['guestsCat'] = \App\GuestsCategory::where('user_id',$userId)->where('status','=','1')->get();
        $data['guestsEvent'] = GuestsEvent::where('user_id',$userId)->where('tables','Yes')->get();
        $user_partner = UserPartners::where('user_id',$userId)->get()->toArray();
        $data['guestsCat'] = $this->changeValuearray($data['guestsCat'], $user_partner);
        $data['countries'] = \App\Countries::where('status','=',1)->get()->toArray();
        $data['guests_event'] = GuestsEvent::with(['guestsInvitationCount'])->where('user_id',$userId)->get();
        return view('tools.seating_chart',['data' => $data]);
    }

    /*
    * Save table Data
    */
    public function save_tabledata(Request $request)
    {
        $userId =  \Auth::user()->id;
        // dd($request->all());
        $idEvents = $request->idEvents;
        $responce = array();
        $tableHtml = '';
        $TableType = $request->input('TableType');
        $TableName = $request->input('TableName');
        $TableSeats = $request->input('TableSeats');

        $posX = $request->input('posX');
        $posY = $request->input('posY');
        $minChairs = $request->input('minChairs');
        $maxChairs = $request->input('maxChairs');

        $chartlistArray = SeatingChartlist::where('user_id', "=", $userId)->get();
        $chartlistID = $chartlistArray[0]->id;

        $chartObj = new SeatingChart;
        $chartObj->user_id = $userId;
        $chartObj->event_id = $idEvents;
        $chartObj->chart_list_id = $chartlistID;
        $chartObj->table_nm = $TableName;
        $chartObj->table_type = $TableType;
        $chartObj->table_seat = $TableSeats;
        $chartObj->minChairs = $minChairs;
        $chartObj->maxChairs = $maxChairs;
        $chartObj->posX = $posX;
        $chartObj->posY = $posY;
        // For 2 side seating table function
        if($TableType == '2side') {
            $sideChairtop = round($TableSeats / 2);
            $sideChairbottom = $TableSeats - $sideChairtop;
            $chartObj->top_seat = $sideChairtop;
            $chartObj->bottom_seat = $sideChairbottom;
            $tableWith = $TableSeats * 25;
            $chartObj->table_width = $tableWith;
            $chartObj->save();
            $tableHtml = '<div id="table_'.$chartObj->id.'" class="app-mesa-item tools-tables-gridItem  ui-draggable ui-droppable" style="position: absolute; visibility: visible; top: '.$posY.'px; left: '.$posX.'px;" data-invitados="" data-numchairs="'.$TableSeats.'" data-type="'.$TableType.'" data-name="'.$TableName.'" data-posx="'.$posX.'" data-posy="'.$posY.'">';
                $tableHtml .=  '<div class="tools-tables-gridItem-settings app-table-settings" style="display: none;">
                                <div class="app-table-remove mb15" data-id="table_'.$chartObj->id.'">
                                    <i class="icon-tools-seating icon-tools-tables-trash"></i>
                                    <i class="icon-tools-seating icon-tools-tables-trash-hover dnone"></i>
                                </div>
                                <div class="app-table-edit mb15" data-id="table_'.$chartObj->id.'">
                                    <i class="icon-tools-seating icon-tools-tables-edit"></i>
                                    <i class="icon-tools-seating icon-tools-tables-edit-hover dnone"></i>
                                </div>
                            </div>';
                 $tableHtml .=  '<div style="height:34px; margin-bottom:-4px;">';
                     $i = 0;
                     while ( $i < $sideChairtop) {
                          $tableHtml .= '<div style="margin: 0 7px; float:left;" class="app-table-seat tools-tables-gridItem-seat ui-droppable" id="table_'.$chartObj->id.'_s'.$i.'" tbl-id="'.$chartObj->id.'"></div>';
                        $i++;
                    }
                 $tableHtml .= '</div>';
                 $tableHtml .= '<div class="tools-tables-gridItem-table tools-tables-gridItem-square" style="height:50px; width:'.$tableWith.'px;"> <div class="tools-tables-gridItem-squareLabel " id="">&nbsp; '.$TableName.' &nbsp;</div></div>';
                 $tableHtml .=  '<div style="height:34px; margin-bottom:-4px;">';
                     $j = 0;
                     while ( $j < $sideChairbottom) {
                            $styleMargin = '';
                            if($sideChairtop > $sideChairbottom && $j== 0) {
                                $styleMargin = '0 7px 0 32px';
                            }else {
                                $styleMargin = '0 7px';
                            }
                          $tableHtml .= '<div style="margin: '.$styleMargin.'; float:left;" class="app-table-seat tools-tables-gridItem-seat ui-droppable" id="table_'.$chartObj->id.'_s'.$i.'" tbl-id="'.$chartObj->id.'"></div>';
                        $i++;
                        $j++;
                     }
                $tableHtml .= '</div>';
            $tableHtml .= '</div>';
        }
        // For 2 side seating table function
        if($TableType == '1side') {
            $chartObj->top_seat = $TableSeats;
            $tableWith = $TableSeats * 50;
            $chartObj->table_width = $tableWith;
            $chartObj->save();
                $tableHtml = '<div id="table_'.$chartObj->id.'" class="app-mesa-item tools-tables-gridItem  ui-draggable ui-droppable" style="position: absolute; visibility: visible; top: '.$posY.'px; left: '.$posX.'px;" data-invitados="" data-numchairs="'.$TableSeats.'" data-type="'.$TableType.'" data-name="'.$TableName.'" data-posx="'.$posX.'" data-posy="'.$posY.'">';
                $tableHtml .=  '<div class="tools-tables-gridItem-settings app-table-settings" style="display: none;">
                                <div class="app-table-remove mb15" data-id="table_'.$chartObj->id.'">
                                    <i class="icon-tools-seating icon-tools-tables-trash"></i>
                                    <i class="icon-tools-seating icon-tools-tables-trash-hover dnone"></i>
                                </div>
                                <div class="app-table-edit mb15" data-id="table_'.$chartObj->id.'">
                                    <i class="icon-tools-seating icon-tools-tables-edit"></i>
                                    <i class="icon-tools-seating icon-tools-tables-edit-hover dnone"></i>
                                </div>
                            </div>';
                $tableHtml .=  '<div style="height:34px; margin-bottom:-4px;">';
                    $i = 0;
                    while ( $i < $TableSeats) {
                          $tableHtml .= '<div style="margin: 0 7px; float:left;" class="app-table-seat tools-tables-gridItem-seat ui-droppable" id="table_'.$chartObj->id.'_s'.$i.'" tbl-id="'.$chartObj->id.'"></div>';
                        $i++;
                    }
                $tableHtml .= '</div>';
                $tableHtml .= '<div class="tools-tables-gridItem-table tools-tables-gridItem-square" style="height:50px; width:'.$tableWith.'px;"> <div class="tools-tables-gridItem-squareLabel " id="">&nbsp; '.$TableName.' &nbsp;</div></div>';
            $tableHtml .= '</div>';
        }
        // For Round2 seating table function
        if($TableType == 'round2') {
            $tableWith = $TableSeats * 25.6;
            $circleDiameter = $tableWith * 60/100;
            $circleRedius = $circleDiameter / 2;
            $transform = round(($circleRedius + 17.5) - 2);
            $circleAngle = intval(360 / $TableSeats);
            $chartObj->table_width = $tableWith;
            $chartObj->circle_tansform = $transform;
            $chartObj->circle_angle = $circleAngle;
            $chartObj->save();
            $seatAngle = 270;
            $tableHtml .= '<div class="app-mesa-item tools-tables-gridItem ui-draggable ui-droppable" id="table_'.$chartObj->id.'" style="width: '.$tableWith.'px; height: '.$tableWith.'px; position: absolute; visibility: visible; top: '.$posY.'px; left: '.$posX.'px;" data-invitados="" data-numchairs="'.$TableSeats.'" data-type="'.$TableType.'" data-name="'.$TableName.'" data-posx="'.$posX.'" data-posy="'.$posY.'">';
                $tableHtml .= '<div class="tools-tables-gridItem-table tools-tables-gridItem-circle" style="z-index: -1">
                    <div class="tools-tables-gridItem-circleLabel" id="table_'.$chartObj->id.'">'.$TableName.'</div>
                    </div>';
                    $i = 0;
                while ( $i < $TableSeats) {
                    $tableHtml .= '<div id="table_'.$chartObj->id.'_s'.$i.'" tbl-id="'.$chartObj->id.'" class="app-table-seat tools-tables-gridItem-seat ui-droppable" style="position: absolute; top: calc(50% - 17.5px); left: calc(50% - 17.5px); z-index: -1; transform: rotate('.$seatAngle.'deg) translate('.$transform.'px) rotate(-'.$seatAngle.'deg);"></div>';
                    $seatAngle = $seatAngle + $circleAngle;
                    if($seatAngle > 360) {
                        $seatAngle = $seatAngle - 360;
                    }elseif($seatAngle == 360) {
                        $seatAngle = 0;
                    }
                    $i++;
                }
                $tableHtml .=  '<div class="tools-tables-gridItem-settings app-table-settings" style="display: none;">
                            <div class="app-table-remove mb15" data-id="table_'.$chartObj->id.'">
                                <i class="icon-tools-seating icon-tools-tables-trash"></i>
                                <i class="icon-tools-seating icon-tools-tables-trash-hover dnone"></i>
                            </div>
                            <div class="app-table-edit mb15" data-id="table_'.$chartObj->id.'">
                                <i class="icon-tools-seating icon-tools-tables-edit"></i>
                                <i class="icon-tools-seating icon-tools-tables-edit-hover dnone"></i>
                            </div>
                        </div>';
            $tableHtml .= '</div>';
        }
        // For square seating table function
        if($TableType == 'square') {
            $tableWith = ($TableSeats * 30)/2;
            $seatCountrow = round($TableSeats / 4);
            $chartObj->table_width = $tableWith;
            $chartObj->top_seat = $seatCountrow;
            $chartObj->left_seat = $seatCountrow;
            $chartObj->right_seat = $seatCountrow;
            $chartObj->bottom_seat = ( $TableSeats - ($seatCountrow * 3) );
            $chartObj->save();
            $tableHtml .= '<div id="table_'.$chartObj->id.'" class="app-mesa-item tools-tables-gridItem flexItem ui-draggable ui-droppable" style="position: absolute; visibility: visible; top: '.$posY.'px; left: '.$posX.'px;" data-invitados="" data-numchairs="'.$TableSeats.'" data-type="'.$TableType.'" data-name="'.$TableName.'" data-posx="'.$posX.'" data-posy="'.$posY.'">';
                $tableHtml .= '<div class="tools-tables-gridItem-settings app-table-settings" style="display: none;">
                                  <div class="app-table-remove mb15" data-id="table_'.$chartObj->id.'">
                                      <i class="icon-tools-seating icon-tools-tables-trash"></i>
                                      <i class="icon-tools-seating icon-tools-tables-trash-hover dnone"></i>
                                  </div>
                                  <div class="app-table-edit mb15" data-id="table_'.$chartObj->id.'">
                                      <i class="icon-tools-seating icon-tools-tables-edit"></i>
                                      <i class="icon-tools-seating icon-tools-tables-edit-hover dnone"></i>
                                  </div>
                              </div>';
                 $tableHtml .= '<div class="tools-tables-gridItem-topSide">';
                      $i = 1;
                      while ( $i <= $seatCountrow ) {
                        $tableHtml .= '<div class="app-table-seat tools-tables-gridItem-seat seatX ui-droppable" id="tables_'.$chartObj->id.'_s'.$i.'" tbl-id="'.$chartObj->id.'"></div>';
                        $i++;
                      }
                 $tableHtml .= ' </div>';
                 $tableHtml .= '<div class="flex">';
                      $tableHtml .= '<div class="tools-tables-gridItem-lateralSide leftSide">';
                        $j = 1;
                         while ( $j <= $seatCountrow ) {
                          $tableHtml .= '<div class="app-table-seat tools-tables-gridItem-seat seatY ui-droppable" id="table_'.$chartObj->id.'_s'.$i.'" tbl-id="'.$chartObj->id.'"></div>';
                          $j++; $i++;
                        }
                      $tableHtml .= '</div>';
                      $tableHtml .= '<div class="tools-tables-gridItem-table tools-tables-gridItem-square flex-va-center" style="height:'.$tableWith.'px; width:'.$tableWith.'px;">
                          <div class="tools-tables-gridItem-squareLabel" id="table1140089_label">'.$TableName.'</div>
                      </div>';
                      $tableHtml .= '<div class="tools-tables-gridItem-lateralSide rightSide">';
                        $k = 1;
                         while ( $k <= $seatCountrow ) {
                          $tableHtml .= '<div class="app-table-seat tools-tables-gridItem-seat seatY ui-droppable" id="table_'.$chartObj->id.'_s'.$i.'" tbl-id="'.$chartObj->id.'"></div>';
                          $k++; $i++;
                        }
                      $tableHtml .= '</div>';
                 $tableHtml .= '</div>';
                 $tableHtml .= '<div class="tools-tables-gridItem-bottomSide">';
                     $l = 1;
                        while ( $l <= $chartObj->bottom_seat ) {
                          $tableHtml .=  '<div class="app-table-seat tools-tables-gridItem-seat seatX ui-droppable" id="table_'.$chartObj->id.'_s'.$i.'" tbl-id="'.$chartObj->id.'"></div>';
                          $l++; $i++;
                        }
                $tableHtml .= '</div>';
            $tableHtml .= '</div>';
        }
        // For noSeats seating table function
        if($TableType == 'noSeats') {
            $tableWith = $request->tableSize * 50;
            $chartObj->table_width = $tableWith;
            $chartObj->subtype = $request->subtype;
            $chartObj->tableSize = $request->tableSize;
            $chartObj->save();
            if($tableWith == 50) {
              $tableWith = '';
            }
            $tableHtml .= '<div id="table_'.$chartObj->id.'" class="app-mesa-item tools-tables-gridItem flexItem ui-draggable ui-droppable" style="position: absolute; visibility: visible; top: '.$posY.'px; left: '.$posX.'px;" data-invitados="" data-numchairs="'.$TableSeats.'" data-type="'.$TableType.'" data-name="'.$TableName.'" data-posx="'.$posX.'" data-posy="'.$posY.'">';
              $tableHtml .= '<div class="tools-tables-gridItem-settings app-table-settings" style="display: none;">
                                <div class="app-table-remove mb15" data-id="table_'.$chartObj->id.'">
                                    <i class="icon-tools-seating icon-tools-tables-trash"></i>
                                    <i class="icon-tools-seating icon-tools-tables-trash-hover dnone"></i>
                                </div>
                                <div class="app-table-edit mb15" data-id="table_'.$chartObj->id.'">
                                    <i class="icon-tools-seating icon-tools-tables-edit"></i>
                                    <i class="icon-tools-seating icon-tools-tables-edit-hover dnone"></i>
                                </div>
                            </div>';
                $tableHtml .=  '<div class="flex">
                                  <div class="tools-tables-gridItem-table tools-tables-gridItem-square flex-va-center" style="height:'.$tableWith.'px; width:'.$tableWith.'px;">
                                      <div class="tools-tables-gridItem-squareLabel" id="table_'.$chartObj->id.'_label">'.$TableName.'</div>
                                  </div>
                                </div>';
            $tableHtml .= '</div>';
        }
        $chartObjupdate = SeatingChart::find($chartObj->id);
        $chartObjupdate->table_html = $tableHtml;
        $chartObjupdate->save();
        $responce['tablewidth'] = $tableWith;
        $responce['tableHtml'] = $tableHtml;
        $responce['tableType'] = $TableType;
        return json_encode($responce);
    } // end of save_tabledata

    /*
    *
    *  Remove chart table
    *
    */
    public function remove_chart_table(Request $request)
    {
        // dd($request->all());
        $responce = array();
        $tableidstr = $request->tableID;
        $tableidArray = explode('_', $tableidstr);
        $objDelete = SeatingChart::find($tableidArray[1]);
        $objDelete->delete();
        //// remove gust form seat....
        $seatidarray = SeatArrangement::where('chart_table_id','=',$tableidArray[1])->get();
        foreach($seatidarray as $chart) {
            $seatDeleteObj = SeatArrangement::find($chart->id);
            $seatDeleteObj->delete();
        }
        //// remove table form invitation....
        $invGuests = GuestsInvitationEvents::where('tables',$tableidArray[1])->get();
        foreach($invGuests as $inv) {
            $invUpdateObj = GuestsInvitationEvents::find($inv->id);
            $invUpdateObj->tables = NULL;
            $invUpdateObj->save();
        }
        $responce['removeid'] = $tableidstr;
        return json_encode($responce);
    }

    /*
    * Edit Chart Table
    */
    public function edit_chart_table($id)
    {
        $tableidArray = explode('_', $id);
        $objChartedit = SeatingChart::find($tableidArray[1]);
        return $objChartedit->toArray();
    }

    /*
    * Update table data
    */
    public function update_chart_table(Request $request)
    {
        //dd($request->all());
        $TableId = $request->TableId;
        $idEvents = $request->idEvents;
        $TableType = $request->TableType;
        $posX = $request->posX;
        $posY = $request->posY;
        $minChairs = $request->minChairs;
        $maxChairs = $request->maxChairs;
        $TableName = $request->TableName;
        $TableSeats = $request->TableSeats;
        $tableHtml = '';
        $responce = array();
        $removeGustarray = array();
        $tblObjupdate = SeatingChart::find($TableId);
        $tblObjupdate->event_id = $idEvents;
        $tblObjupdate->table_nm = $TableName;
        $tblObjupdate->table_seat = $TableSeats;
        // Delete All user from seat when table update
        $tableSeatArray = SeatArrangement::where('chart_table_id','=',$TableId)->get();
        foreach ($tableSeatArray as $key => $tableSeatdata) {
            $previousGustobj = SeatArrangement::find($tableSeatdata->id);
            $previousGustobj->delete();
            $removeGustarray[] = $tableSeatdata->gust_id;
        }
        //// remove table form invitation....
        $invGuests = GuestsInvitationEvents::where('tables',$TableId)->get();
        foreach($invGuests as $inv) {
            $invUpdateObj = GuestsInvitationEvents::find($inv->id);
            $invUpdateObj->tables = NULL;
            $invUpdateObj->save();
        }
        // For 2side seating table function
        if($TableType == '2side') {
            $sideChairtop = round($TableSeats / 2);
            $sideChairbottom = $TableSeats - $sideChairtop;
            $tblObjupdate->top_seat = $sideChairtop;
            $tblObjupdate->bottom_seat = $sideChairbottom;
            $tableWith = $TableSeats * 25;
            $tblObjupdate->table_width = $tableWith;
            $tblObjupdate->save();
            $tableHtml = '<div id="table_'.$TableId.'" class="app-mesa-item tools-tables-gridItem  ui-draggable ui-droppable" style="position: absolute; visibility: visible; top: '.$posY.'px; left: '.$posX.'px;" data-invitados="" data-numchairs="'.$TableSeats.'" data-type="'.$TableType.'" data-name="'.$TableName.'" data-posx="'.$posX.'" data-posy="'.$posY.'">';
            $tableHtml .=  '<div class="tools-tables-gridItem-settings app-table-settings" style="display: none;">
                                <div class="app-table-remove mb15" data-id="table_'.$TableId.'">
                                    <i class="icon-tools-seating icon-tools-tables-trash"></i>
                                    <i class="icon-tools-seating icon-tools-tables-trash-hover dnone"></i>
                                </div>
                                <div class="app-table-edit mb15" data-id="table_'.$TableId.'">
                                    <i class="icon-tools-seating icon-tools-tables-edit"></i>
                                    <i class="icon-tools-seating icon-tools-tables-edit-hover dnone"></i>
                                </div>
                            </div>';
            $tableHtml .=  '<div style="height:34px; margin-bottom:-4px;">';
                $i = 0;
                while ( $i < $sideChairtop) {
                    $tableHtml .= '<div style="margin: 0 7px; float:left;" class="app-table-seat tools-tables-gridItem-seat ui-droppable" id="table_'.$tblObjupdate->id.'_s'.$i.'" tbl-id="'.$tblObjupdate->id.'"></div>';
                  $i++;
                }
            $tableHtml .= '</div>';
            $tableHtml .= '<div class="tools-tables-gridItem-table tools-tables-gridItem-square" style="height:50px; width:'.$tableWith.'px;"> <div class="tools-tables-gridItem-squareLabel " id="">&nbsp; '.$TableName.' &nbsp;</div></div>';
            $tableHtml .=  '<div style="height:34px; margin-bottom:-4px;">';
                $j = 0;
                while ( $j < $sideChairbottom) {
                      $styleMargin = '';
                      if($sideChairtop > $sideChairbottom && $j== 0) {
                          $styleMargin = '0 7px 0 32px';
                      }else {
                           $styleMargin = '0 7px';
                      }
                    $tableHtml .= '<div style="margin: '.$styleMargin.'; float:left;" class="app-table-seat tools-tables-gridItem-seat ui-droppable" id="table_'.$tblObjupdate->id.'_s'.$i.'" tbl-id="'.$tblObjupdate->id.'"></div>';
                    $i++;
                    $j++;
                }
            $tableHtml .= '</div>';
            $tableHtml .= '</div>';
        }
        // For 1side seating table function
        if($TableType == '1side') {
            $tblObjupdate->top_seat = $TableSeats;
            $tableWith = $TableSeats * 50;
            $tblObjupdate->table_width = $tableWith;
            $tblObjupdate->save();
            $tableHtml = '<div id="table_'.$TableId.'" class="app-mesa-item tools-tables-gridItem  ui-draggable ui-droppable" style="position: absolute; visibility: visible; top: '.$posY.'px; left: '.$posX.'px;" data-invitados="" data-numchairs="'.$TableSeats.'" data-type="'.$TableType.'" data-name="'.$TableName.'" data-posx="'.$posX.'" data-posy="'.$posY.'">';
            $tableHtml .=  '<div class="tools-tables-gridItem-settings app-table-settings" style="display: none;">
                          <div class="app-table-remove mb15" data-id="table_'.$TableId.'">
                              <i class="icon-tools-seating icon-tools-tables-trash"></i>
                              <i class="icon-tools-seating icon-tools-tables-trash-hover dnone"></i>
                          </div>
                          <div class="app-table-edit mb15" data-id="table_'.$TableId.'">
                              <i class="icon-tools-seating icon-tools-tables-edit"></i>
                              <i class="icon-tools-seating icon-tools-tables-edit-hover dnone"></i>
                          </div>
                      </div>';
            $tableHtml .=  '<div style="height:34px; margin-bottom:-4px;">';
               $i = 0;
               while ( $i < $TableSeats) {
                    $tableHtml .= '<div style="margin: 0 7px; float:left;" class="app-table-seat tools-tables-gridItem-seat ui-droppable" id="table_'.$tblObjupdate->id.'_s'.$i.'" tbl-id="'.$tblObjupdate->id.'"></div>';
                  $i++;
                }
            $tableHtml .= '</div>';
            $tableHtml .= '<div class="tools-tables-gridItem-table tools-tables-gridItem-square" style="height:50px; width:'.$tableWith.'px;"> <div class="tools-tables-gridItem-squareLabel " id="">&nbsp; '.$TableName.' &nbsp;</div></div>';
            $tableHtml .= '</div>';
        }
        // For round2 seating table function 
        if($TableType == 'round2') {
            $tableWith = $TableSeats * 25.6;
            $circleDiameter = $tableWith * 60/100;
            $circleRedius = $circleDiameter / 2;
            $transform = round(($circleRedius + 17.5) - 2);
            $circleAngle = intval(360 / $TableSeats);
            $tblObjupdate->table_width = $tableWith;
            $tblObjupdate->circle_tansform = $transform;
            $tblObjupdate->circle_angle = $circleAngle;
            $tblObjupdate->save();
            $seatAngle = 270;
            $tableHtml .= '<div class="app-mesa-item tools-tables-gridItem ui-draggable ui-droppable" id="table_'.$TableId.'" style="width: '.$tableWith.'px; height: '.$tableWith.'px; position: absolute; visibility: visible; top: '.$posY.'px; left: '.$posX.'px;" data-invitados="" data-numchairs="'.$TableSeats.'" data-type="'.$TableType.'" data-name="'.$TableName.'" data-posx="'.$posX.'" data-posy="'.$posY.'">';

                $tableHtml .= '<div class="tools-tables-gridItem-table tools-tables-gridItem-circle" style="z-index: -1">
                    <div class="tools-tables-gridItem-circleLabel" id="table_'.$TableId.'">'.$TableName.'</div>
                  </div>';
                  $i = 0;
                  while ( $i < $TableSeats) {
                     $tableHtml .= '<div id="table_'.$tblObjupdate->id.'_s'.$i.'" tbl-id="'.$tblObjupdate->id.'" class="app-table-seat tools-tables-gridItem-seat ui-droppable" style="position: absolute; top: calc(50% - 17.5px); left: calc(50% - 17.5px); z-index: 1; transform: rotate('.$seatAngle.'deg) translate('.$transform.'px) rotate(-'.$seatAngle.'deg);"></div>';
                    $seatAngle = $seatAngle + $circleAngle;

                    if($seatAngle > 360) {
                      $seatAngle = $seatAngle - 360;
                    }elseif($seatAngle == 360) {
                        $seatAngle = 0;
                    }
                    $i++;
                  }
                $tableHtml .=  '<div class="tools-tables-gridItem-settings app-table-settings" style="display: none;">
                            <div class="app-table-remove mb15" data-id="table_'.$TableId.'">
                                <i class="icon-tools-seating icon-tools-tables-trash"></i>
                                <i class="icon-tools-seating icon-tools-tables-trash-hover dnone"></i>
                            </div>
                            <div class="app-table-edit mb15" data-id="table_'.$TableId.'">
                                <i class="icon-tools-seating icon-tools-tables-edit"></i>
                                <i class="icon-tools-seating icon-tools-tables-edit-hover dnone"></i>
                            </div>
                        </div>';
            $tableHtml .= '</div>';
        }
        // For square seating table function 
        if($TableType == 'square') {
            $tableWith = ($TableSeats * 30)/2;
            $seatCountrow = round($TableSeats / 4);
            $tblObjupdate->table_width = $tableWith;
            $tblObjupdate->top_seat = $seatCountrow;
            $tblObjupdate->left_seat = $seatCountrow;
            $tblObjupdate->right_seat = $seatCountrow;
            $tblObjupdate->bottom_seat = ( $TableSeats - ($seatCountrow * 3) );
            $tblObjupdate->save();
            $tableHtml .= '<div id="table_'.$TableId.'" class="app-mesa-item tools-tables-gridItem flexItem ui-draggable ui-droppable" style="position: absolute; visibility: visible; top: '.$posY.'px; left: '.$posX.'px;" data-invitados="" data-numchairs="'.$TableSeats.'" data-type="'.$TableType.'" data-name="'.$TableName.'" data-posx="'.$posX.'" data-posy="'.$posY.'">';
                $tableHtml .= '<div class="tools-tables-gridItem-settings app-table-settings" style="display: none;">
                                  <div class="app-table-remove mb15" data-id="table_'.$TableId.'">
                                      <i class="icon-tools-seating icon-tools-tables-trash"></i>
                                      <i class="icon-tools-seating icon-tools-tables-trash-hover dnone"></i>
                                  </div>
                                  <div class="app-table-edit mb15" data-id="table_'.$TableId.'">
                                      <i class="icon-tools-seating icon-tools-tables-edit"></i>
                                      <i class="icon-tools-seating icon-tools-tables-edit-hover dnone"></i>
                                  </div>
                              </div>';
                $tableHtml .= '<div class="tools-tables-gridItem-topSide">';
                  $i = 1;
                  while ( $i <= $seatCountrow ) {
                    $tableHtml .= '<div class="app-table-seat tools-tables-gridItem-seat seatX ui-droppable" id="table_'.$tblObjupdate->id.'_s'.$i.'" tbl-id="'.$tblObjupdate->id.'"></div>';
                    $i++;
                  }
                $tableHtml .= ' </div>';
                $tableHtml .= '<div class="flex">';
                $tableHtml .= '<div class="tools-tables-gridItem-lateralSide leftSide">';
                    $j = 1;
                     while ( $j <= $seatCountrow ) {
                      $tableHtml .= '<div class="app-table-seat tools-tables-gridItem-seat seatY ui-droppable" id="table_'.$tblObjupdate->id.'_s'.$i.'" tbl-id="'.$tblObjupdate->id.'"></div>';
                      $j++; $i++;
                    }
                  $tableHtml .= '</div>';
                  $tableHtml .= '<div class="tools-tables-gridItem-table tools-tables-gridItem-square flex-va-center" style="height:'.$tableWith.'px; width:'.$tableWith.'px;">
                      <div class="tools-tables-gridItem-squareLabel" id="table1140089_label">'.$TableName.'</div>
                  </div>';
                  $tableHtml .= '<div class="tools-tables-gridItem-lateralSide rightSide">';
                    $k = 1;
                     while ( $k <= $seatCountrow ) {
                      $tableHtml .= '<div class="app-table-seat tools-tables-gridItem-seat seatY ui-droppable" id="table_'.$tblObjupdate->id.'_s'.$i.'" tbl-id="'.$tblObjupdate->id.'"></div>';
                      $k++; $i++;
                    }
                  $tableHtml .= '</div>';
                $tableHtml .= '</div>';
                $tableHtml .= '<div class="tools-tables-gridItem-bottomSide">';
                     $l = 1;
                        while ( $l <= $tblObjupdate->bottom_seat ) {
                          $tableHtml .=  '<div class="app-table-seat tools-tables-gridItem-seat seatX ui-droppable" id="table_'.$tblObjupdate->id.'_s'.$i.'" tbl-id="'.$tblObjupdate->id.'"></div>';
                          $l++; $i++;
                        }
                $tableHtml .= '</div>';
            $tableHtml .= '</div>';
        }
        // For noSeats seating table function 
        if($TableType == 'noSeats') {
            $tableWith = $request->tableSize * 50;
            $tblObjupdate->table_width = $tableWith;
            $tblObjupdate->subtype = $request->subtype;
            $tblObjupdate->tableSize = $request->tableSize;
            $tblObjupdate->save();
            if($tableWith == 50) {
              $tableWith = '';
            }
            $tableHtml .= '<div id="table_'.$TableId.'" class="app-mesa-item tools-tables-gridItem flexItem ui-draggable ui-droppable" style="position: absolute; visibility: visible; top: '.$posY.'px; left: '.$posX.'px;" data-invitados="" data-numchairs="'.$TableSeats.'" data-type="'.$TableType.'" data-name="'.$TableName.'" data-posx="'.$posX.'" data-posy="'.$posY.'">';
            $tableHtml .= '<div class="tools-tables-gridItem-settings app-table-settings" style="display: none;">
                            <div class="app-table-remove mb15" data-id="table_'.$TableId.'">
                                <i class="icon-tools-seating icon-tools-tables-trash"></i>
                                <i class="icon-tools-seating icon-tools-tables-trash-hover dnone"></i>
                            </div>
                            <div class="app-table-edit mb15" data-id="table_'.$TableId.'">
                                <i class="icon-tools-seating icon-tools-tables-edit"></i>
                                <i class="icon-tools-seating icon-tools-tables-edit-hover dnone"></i>
                            </div>
                        </div>';
            $tableHtml .=  '<div class="flex">
                          <div class="tools-tables-gridItem-table tools-tables-gridItem-square flex-va-center" style="height:'.$tableWith.'px; width:'.$tableWith.'px;">
                              <div class="tools-tables-gridItem-squareLabel" id="table_'.$TableId.'_label">'.$TableName.'</div>
                          </div>
                        </div>';
            $tableHtml .= '</div>';
        }
        $tblObjupdate->table_html = $tableHtml;
        $tblObjupdate->save();
        $responce['table_updateid'] = 'table_'.$TableId;
        $responce['tableHtml'] = $tableHtml;
        $responce['tablewidth'] = $tableWith;
        $responce['tableType'] = $TableType;
        $responce['removeGustids'] = $removeGustarray;
        return json_encode($responce);
    } // end of update_chart_table

    /*
    *
    *   Update table position
    *
    */
    public function update_table_positions(Request $request)
    {
        //dd($request->all());
        $responce = array();
        $tableidstr = $request->tableID;
        $tableidArray = explode('_', $tableidstr);
        $objChartposition = SeatingChart::find($tableidArray[1]);
        $objChartposition->posX = $request->posX;
        $objChartposition->posY = $request->posY;
        $objChartposition->save();

        $userId =  \Auth::user()->id;
        $seatinListarray = SeatingChartlist::where('user_id', '=', $userId)->get();
        $seatlistID = $seatinListarray[0]->id;

        $seatingChartlistobj = SeatingChartlist::find($seatlistID);
        $seatingChartlistobj->tbl_height = $request->height;
        $seatingChartlistobj->tbl_width = $request->width;
        $seatingChartlistobj->save();

        $responce['tableid'] = $objChartposition->id;
        return json_encode($responce);
    }

    /*
    *
    * Update table chart list height width
    *
    */
    public function update_chart_table_list(Request $request)
    {
        $userId =  \Auth::user()->id;
        $seatinListarray = SeatingChartlist::where('user_id', '=', $userId)->get();
        $seatlistID = $seatinListarray[0]->id;

        $seatingChartlistobj = SeatingChartlist::find($seatlistID);
        $seatingChartlistobj->tbl_height = $request->height;
        $seatingChartlistobj->tbl_width = $request->width;
        $seatingChartlistobj->save();
    }

    /*
    *
    * Seat arragment for gust on seat
    *
    */
    public function seat_arrangement(Request $request)
    {
        //dd($request->all());
        $responce = array();
        // Delete previous gust from seat
        if($request->previousGustid) {
            $previousGustArray = SeatArrangement::where('gust_id',$request->previousGustid)->where('event_id',$request->idEvents)->get();
            $previousGust = $previousGustArray[0]->id;
            $previousGustobj = SeatArrangement::find($previousGust);
            $previousGustobj->delete();
            $responce['previousGustid'] = $request->previousGustid;
        }
        // Add New gust on seat
        $userId =  \Auth::user()->id;
        $seatinListarray = SeatingChartlist::where('user_id', '=', $userId)->get();
        $chartListid = $seatinListarray[0]->id;

        $seatArrangmentObj = new SeatArrangement;
        $seatArrangmentObj->user_id = $userId;
        $seatArrangmentObj->gust_id = $request->gustid;
        $seatArrangmentObj->event_id = $request->idEvents;
        $seatArrangmentObj->chart_list_id  = $chartListid;
        $seatArrangmentObj->chart_table_id  = $request->tableId;
        $seatArrangmentObj->seat_id = $request->seatId;
        $seatArrangmentObj->seat_gust_html = $request->seatHtml;
        $seatArrangmentObj->save();
        if($seatArrangmentObj->id) {
            ////// update initation table id as new id......
            $invtTable = GuestsInvitationEvents::where('invited_for',$request->idEvents)->where('guest_id',$request->gustid)->first();
            $invtTableUpd = GuestsInvitationEvents::find($invtTable->id);
            $invtTableUpd->tables = $request->tableId;
            $invtTableUpd->save();
        }
        return json_encode($responce);
    }

    /*
    *
    *   Delete gust from seat
    *
    */
    public function seat_arrangement_delete(Request $request)
    {
        //dd($request->all());
        $seatArrangmentArray = SeatArrangement::where('gust_id',$request->gustid)->where('event_id',$request->idEvents)->get();
        $seatId = $seatArrangmentArray[0]->id;
        //// delete guest seating....
        $objDelete = SeatArrangement::find($seatId);
        $objDelete->delete();
        //// update guest invitation....
        $invtTable = GuestsInvitationEvents::where('invited_for',$request->idEvents)->where('guest_id',$request->gustid)->first();
        $invtTableUpd = GuestsInvitationEvents::find($invtTable->id);
        $invtTableUpd->tables = NULL;
        $invtTableUpd->save();
    }

    /*
    *
    * Get gust list for user
    *
    */
    // public function get_guestlist()
    // {
    //     $userId =  \Auth::user()->id;
    //     $data['guestListData']=GuestsCategory::with(['Guestlist' => function($query) use($userId){
    //         $query->where('user_id','=',$userId);
    //     }])->get();
    //     $output = '';
    //     foreach($data["guestListData"] as $liss) {
    //         if(count($liss['Guestlist']) !=0) {
    //             $output.= '<div class="app-tools-tables-group">
    //                 <p class="app-tools-tables-group-title tools-tables-left-guests-family-title">'.$liss["title"].'</p>
    //                 <ul class="app-tools-tables-group-family tools-tables-left-guests-family">';
    //             foreach($liss['Guestlist'] as $lissguest) {
    //                 if(isset($lissguest['tableSeat']['seat_id'])) {
    //                     $style = 'style="display:none"';
    //                     $markCls = 'marked-text';
    //                 } else {
    //                     $style = '';
    //                     $markCls = '';
    //                 }
    //                 $output .= '<a id="editguest" onclick="editguest('.$lissguest["id"].');">
    //                     <li data-position="0" data-proxy="guestProxyBoy" data-grupo="'.$lissguest["group_id"].'" data-nombre="'.$lissguest["name"].'" data-apellidos="'.$lissguest["name"].'" data-seat-id="" data-parent="'.$lissguest['related_id'].'" data-idcontact="" data-confirmado="0" id="i'.$lissguest["id"].'" class="app-tables-persona app-tables-persona-list tools-tables-left-guests-item ui-draggable" '.$style.'>
    //                     <span class="app-tables-guest-name tools-tables-left-guests-name parent '.$markCls.'">'.$lissguest["name"].'</span>';
    //                 $iconType = '';
    //                 if( $lissguest['age_type'] == 'adult' &&  $lissguest['gender'] == 'male' ) {
    //                     $iconType = 'groom';
    //                 }
    //                 if( $lissguest['age_type'] == 'adult' &&  $lissguest['gender'] == 'female' ) {
    //                     $iconType = 'bride';
    //                 }
    //                 if( $lissguest['age_type'] == 'child' &&  $lissguest['gender'] == 'male' ) {
    //                     $iconType = 'boy';
    //                 }
    //                 if( $lissguest['age_type'] == 'child' &&  $lissguest['gender'] == 'female' ) {
    //                     $iconType = 'girl';
    //                 }
    //                 if( $lissguest['age_type'] == 'baby' &&  $lissguest['gender'] == 'male' ) {
    //                     $iconType = 'child';
    //                 }
    //                 if( $lissguest['age_type'] == 'baby' &&  $lissguest['gender'] == 'female' ) {
    //                     $iconType = 'child';
    //                 }
    //                 if( $lissguest['age_type'] == '' &&  $lissguest['gender'] == '' ) {
    //                     $iconType = 'adult';
    //                 }
    //                 if(isset($lissguest['tableSeat']['seat_id'])) {
    //                     $output .= '<i icontype="'.$iconType.'" class="app-tables-guest-icon icon-tools-seating fright relative icon-tools-guest-dropped dropped"></i>';
    //                 } else {
    //                     $output .=  '<i class="app-tables-guest-icon icon-tools-seating fright relative icon-tools-'.$iconType.'-small"></i>';
    //                 }
    //                 $output .= '</li>
    //                     </li>
    //                 </a>';
    //             }
    //         }
    //         $output .= '</ul>
    //         </div>';
    //     }
    //     return $output;
    // }

    /*
    *
    * Search guest
    *
    */

    public function searchguest(Request $request) {
        $userId =  \Auth::user()->id;
        $search=$request->input('keywords');
        $data['guestListData'] = GuestsList::with('tableSeat')->Where('name', 'like',"%{$search}%")->where('user_id',$userId)->get(); 

         $output='';
            
            if(count($data['guestListData']) !=0) {

                $output.= '<div class="app-tools-tables-group">
                              <ul class="app-tools-tables-group-family tools-tables-left-guests-family">';
                              
                       foreach($data['guestListData'] as $lissguest) { 

                          if(isset($lissguest['tableSeat']['seat_id'])) {
                            $style = 'style="display:none"';
                            $markCls = 'marked-text';
                          } else {
                            $style = '';
                            $markCls = '';
                          }

                          $output .=  '<a id="editguest" onclick="editguest('.$lissguest["id"].');">
                                          <li data-position="0" data-proxy="guestProxyBoy" data-grupo="'.$lissguest["group_id"].'" data-nombre="'.$lissguest["name"].'" data-apellidos="'.$lissguest["name"].'" data-seat-id="" data-parent="'.$lissguest['related_id'].'" data-idcontact="'.$lissguest["id"].'" data-confirmado="0" id="i'.$lissguest["id"].'" class="app-tables-persona app-tables-persona-list tools-tables-left-guests-item ui-draggable" '.$style.'>
                                            <span class="app-tables-guest-name tools-tables-left-guests-name parent '.$markCls.'">'.$lissguest["name"].'</span>';

                                              $iconType = ''; 

                                              if( $lissguest['age_type'] == 'adult' &&  $lissguest['gender'] == 'male' ) {
                                                 $iconType = 'groom'; 
                                              }
                                             
                                              if( $lissguest['age_type'] == 'adult' &&  $lissguest['gender'] == 'female' ) {
                                                $iconType = 'bride'; 
                                              }

                                              if( $lissguest['age_type'] == 'child' &&  $lissguest['gender'] == 'male' ) {
                                                $iconType = 'boy'; 
                                              }
                                              
                                              if( $lissguest['age_type'] == 'child' &&  $lissguest['gender'] == 'female' ) {
                                                $iconType = 'girl'; 
                                              }

                                              if( $lissguest['age_type'] == 'baby' &&  $lissguest['gender'] == 'male' ) {
                                                $iconType = 'child'; 
                                              }

                                              if( $lissguest['age_type'] == 'baby' &&  $lissguest['gender'] == 'female' ) {
                                                $iconType = 'child'; 
                                              }

                                              if( $lissguest['age_type'] == '' &&  $lissguest['gender'] == '' ) {
                                                $iconType = 'adult';
                                              }

                                              if(isset($lissguest['tableSeat']['seat_id'])) {
                                                  $output .= '<i icontype="'.$iconType.'" class="app-tables-guest-icon icon-tools-seating fright relative icon-tools-guest-dropped dropped"></i>';
                                              } else {
                                                  $output .=  '<i class="app-tables-guest-icon icon-tools-seating fright relative icon-tools-'.$iconType.'-small"></i>';
                                              }
                                           
                                           
                                        $output .= '</li>
                                      </a>';
                        }
              
                 $output .= '</ul>
               </div>';
            }
      
         return $output;
    }

    /*
    * Get User list
    *
    */

    public function getUserLists() {

        $userId =  \Auth::user()->id;

        ######### Status use as a task status in todolist table #############

        $listedTasks = TodoList::select('todo_lists.id as list_id','todo_lists.title','todo_lists.description','todo_lists.todo_date_id','todo_lists.todo_cat_id','todo_lists.status as task_status',
            'LC.title as category')
        ->join('todo_list_categories as LC','todo_lists.todo_cat_id','=','LC.id')
        ->where('todo_lists.user_id','=','0')->orWhere('todo_lists.user_id','=',$userId)        
        ->get()->toArray();

        $answerTasks = TodoAnswerList::select('todo_answer_lists.list_id','todo_answer_lists.title','todo_answer_lists.description','todo_answer_lists.todo_date_id','todo_answer_lists.todo_cat_id','todo_answer_lists.task_status',
            'LC.title as category')
         ->join('todo_list_categories as LC','todo_answer_lists.todo_cat_id','=','LC.id')
         ->where('user_id','=',$userId)      
        ->get()->toArray();

        if(isset($listedTasks) && !empty($listedTasks)){
            $answerTaskIds = array();
            if(isset($answerTasks) && !empty($answerTasks)){
                $answerTaskIds = array_column($answerTasks,'list_id');
                foreach($listedTasks as &$vval){
                    if(in_array($vval['list_id'],$answerTaskIds)){
                       $key = array_search($vval['list_id'], $answerTaskIds);
                       $vval['title'] = $answerTasks[$key]['title'];
                       $vval['description'] = $answerTasks[$key]['description'];
                       $vval['todo_date_id'] = $answerTasks[$key]['todo_date_id'];
                       $vval['todo_cat_id'] = $answerTasks[$key]['todo_cat_id'];
                       $vval['task_status'] = $answerTasks[$key]['task_status'];
                       $vval['category'] = $answerTasks[$key]['category'];
                    }
                }
            }
        }

        $totalCounter = $pendingCount = $completeCount = 0;
        $holdFinalArray = array();
        if(isset($listedTasks) && !empty($listedTasks)){
           foreach($listedTasks as $task){
              if($task['task_status'] != 3){
                 $totalCounter += 1;
                 if($task['task_status']==1){ $pendingCount += 1; 
                   if(count($holdFinalArray) < 3){ $holdFinalArray[] = $task; }
                 }
                 if($task['task_status']==2){ $completeCount += 1;}
              }
           }
        }

        $listedTasksNew['total'] = $totalCounter;
        $listedTasksNew['pending'] = $pendingCount;
        $listedTasksNew['complete'] = $completeCount;
        $listedTasksNew['pending_task'] = $holdFinalArray;
        
        return $listedTasksNew;
    }

    /*
    * Get Profile Image
    *
    */
    public function get_profile_img()
    {
        $userId = \Auth::user()->id;
        $profileImage = \Auth::user()->profile_image;
        if(isset($profileImage) && !empty($profileImage)){
            $proImagePath = url('public/storage/USER_'.$userId.'/'.$profileImage);
        } else {
            $proImagePath = url('public/storage/no-image.png');
        }
        return $proImagePath;
    }

    public function profile_pic(Request $request)
    {
        $userId = \Auth::user()->id;
        if(isset($userId) && $userId !=''){
            $userObj = User::findOrFail($userId);
            $userFolder = '/public/USER_'.$userId;
            \Storage::makeDirectory($userFolder, 0755);
            $file_data = $request->input('imageData'); 
            $file_name = time().'_profile_img.png'; //generating unique file name; 
            @list($type, $file_data) = explode(';', $file_data);
            @list(, $file_data) = explode(',', $file_data); 
            if($file_data!=""){ // storing image in storage/app/public Folder 
                  \Storage::put($userFolder.'/'.$file_name,base64_decode($file_data)); 
                  $userObj->profile_image = $file_name;
                  $userObj->save();
            } 
        }
         return \redirect()->back();
    }

    public function my_wedding_pic(Request $request)
    {
        $userId = \Auth::user()->id;
        $test = '';
        if(isset($userId) && $userId !=''){
            $userType = ($request->input('userType')) ?? rand(); 
           // $userObj = UserPartners::findOrFail($userId);
            $userObj = UserPartners::firstOrNew(array('user_id' => $userId));
            $userFolder = '/public/USER_'.$userId;
            \Storage::makeDirectory($userFolder, 0755);
            $file_data = $request->input('imageData'); 
            $file_name = $userType.'_avatar_'.time().'.png'; //generating unique file name; 
            @list($type, $file_data) = explode(';', $file_data);
            @list(, $file_data) = explode(',', $file_data); 
            if($file_data!=""){ // storing image in storage/app/public Folder 
                $test = ' - '.$userFolder.'/'.$file_name;
                \Storage::put($userFolder.'/'.$file_name,base64_decode($file_data)); 
                if($userType == 'partner'){
                    $userObj->partner_avatar = $file_name;
                } else {
                    $userObj->avatar = $file_name;
                }
                $userObj->save();
            }
        }
        return response()->json([
                    'errorVal' => false,
                    'msg' => 'Image has been uploaded'.$test
                ]);
    }

    public function get_venues_list(Request $request){
        $searchKey = $request->input('search_venues');
        if($searchKey){
          $childCatArray = array();
          $childCat = Category::select('id')->where('parent_id','=',1)->get()->toArray();
          if(isset($childCat) && !empty($childCat)){
              $childCatArray = array_column($childCat,'id');
          }
          $data = VendorCompany::select('vendor_companies.vendor_id','vendor_companies.province','vendor_companies.city','vendor_companies.business_name','vendor_companies.business_name_slug')
          ->where('vendor_companies.business_name','like',"$searchKey%")
          ->leftJoin('vendors as VE','vendor_companies.vendor_id','=','VE.vendor_id')
          ->whereIn('VE.cat_id',$childCatArray)->get()->toArray();
           return response()->json($data);
        }else{
            return response()->json(array());
        }
    }



    public function all_vendor_list_search(Request $request){
        $searchKey = $request->input('search_venues');
        if($searchKey){
           $data = VendorCompany::select('vendor_companies.vendor_id','vendor_companies.province','vendor_companies.city','vendor_companies.business_name','vendor_companies.business_name_slug')
              ->leftJoin('vendors as VE','vendor_companies.vendor_id','=','VE.vendor_id')
              ->where('vendor_companies.business_name','like',$searchKey.'%')
              ->where('VE.status','=',1)
              ->where('VE.step_completed','=',4)
              ->get()->toArray();
              return response()->json($data);
        }else{
            return response()->json(array());
        }
    }


    public function get_vendor_list(Request $request)
    {
        $searchKey = $request->input('search_venues');
        $catId = $request->input('cat_id');
        if($searchKey){
          if($catId == 1 || $catId == 2 || $catId == 3 || $catId == 4){ // Parent Category
             $allChildeCat = Category::select(DB::raw('GROUP_CONCAT(id) as ids'))->where('parent_id','=',$catId)->where('status','=',1)->first()->toArray();
             $idsArray = explode(',',$allChildeCat['ids']);
             $data = VendorCompany::select('vendor_companies.vendor_id','vendor_companies.province','vendor_companies.city','vendor_companies.business_name','vendor_companies.business_name_slug')
              ->leftJoin('vendors as VE','vendor_companies.vendor_id','=','VE.vendor_id')
              ->leftJoin('categories as CT','VE.cat_id','=','CT.id')
              ->where('vendor_companies.business_name','like',$searchKey.'%')
              ->orWhere('CT.title','LIKE','%'.$searchKey.'%')->get()->toArray();
              // ->whereIn('VE.cat_id',$idsArray)->get()->toArray();
               return response()->json($data);
          }else{ // Vendor child category
           $data = VendorCompany::select('vendor_companies.vendor_id','vendor_companies.province','vendor_companies.city','vendor_companies.business_name','vendor_companies.business_name_slug')
              ->leftJoin('vendors as VE','vendor_companies.vendor_id','=','VE.vendor_id')
              ->leftJoin('categories as CT','VE.cat_id','=','CT.id')
              ->where('vendor_companies.business_name','like',$searchKey.'%')
              ->orWhere('CT.title','LIKE','%'.$searchKey.'%')
              ->where('VE.cat_id','=',$catId)->get()->toArray();
               return response()->json($data);
          }
        }else{
            return response()->json(array());
        }
    }

    public function get_vendor_list_full(Request $request){
        $catId = $request->input('cat_id');
        if($catId){
           if($catId == 1 || $catId == 2 || $catId == 3 || $catId == 4){    // Parent Category
             $allChildeCat = Category::select(DB::raw('GROUP_CONCAT(id) as ids'))->where('parent_id','=',$catId)->where('status','=',1)->first()->toArray();
             $idsArray = explode(',',$allChildeCat['ids']);
             $data = VendorCompany::select('vendor_companies.vendor_id','vendor_companies.province','vendor_companies.city','vendor_companies.business_name','vendor_companies.business_name_slug')
              ->leftJoin('vendors as VE','vendor_companies.vendor_id','=','VE.vendor_id')
              ->whereIn('VE.cat_id',$idsArray)->get()->toArray();
               return response()->json($data);
          }else{ // Vendor child category
           $data = VendorCompany::select('vendor_companies.vendor_id','vendor_companies.province','vendor_companies.city','vendor_companies.business_name','vendor_companies.business_name_slug')
              ->leftJoin('vendors as VE','vendor_companies.vendor_id','=','VE.vendor_id')
              ->where('VE.cat_id','=',$catId)->get()->toArray();
               return response()->json($data);
          }
        }else{
            return response()->json(array());
        }
    }


    public function save_my_wedding_data(Request $request)
    {
        $this->validate($request, [
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'emails' => 'required|email',
                'partner_firstname' => 'required|string',
                'partner_lastname' => 'required|string',
                'gender' => 'required',
                'partner_gender' => 'required',
            ],[
                'firstname.required'=>'Your Firstname is required.',
                'lastname.required'=>'Your Lastname is required.',
                'emails.required'=>'Your Email is required.',
                'partner_firstname.required'=>'Firstname is required.',
                'partner_lastname.required'=>'Lastname is required.',
                'gender.required'=>'Your Gender is required.',
                'partner_gender.required'=>'Gender is required.',
                'emails.email'=>'Invalid Email Found.',
            ]);
        $userId = \Auth::user()->id;
        if(isset($userId) && $userId !=''){
            $weddingDate = null;
            if($request->input('wedding_date') !== null && $request->input('wedding_date') != ''){
              $myDateTimeVal = \DateTime::createFromFormat('d/m/Y', $request->input('wedding_date'));
              $weddingDate = $myDateTimeVal->format('Y-m-d');
            }
             $userObj = UserPartners::firstOrNew(array('user_id' => $userId));
             $userObj->firstname = $request->input('firstname');
             $userObj->lastname = $request->input('lastname');
             $userObj->email = $request->input('emails');
             $userObj->partner_firstname = $request->input('partner_firstname');
             $userObj->partner_lastname = $request->input('partner_lastname');
             $userObj->partner_email = $request->input('partner_email');
             $userObj->gender = $request->input('gender');
             $userObj->partner_gender = $request->input('partner_gender');
             $userObj->venue = $request->input('venues');
             $userObj->wedding_date = $weddingDate;
             $data = $userObj->save();
             if($data){
                 return response()->json([
                         'errorVal' => false,
                         'msg' => 'Profile has been updated successfully.'
                     ],200);
             }
        }
        return response()->json([
                    'errorVal' => true,
                    'msg' => 'Something went wrong please try again....'
        ],422);
    }

     /**
     * Show the to do list.
     *
     * @return \Illuminate\Http\Response
     */

    public function to_do_list(Request $request)
    {
        $requestData = $request->all();
        if(isset($requestData) && !empty($requestData)){
            $search_status = $requestData['task_status'];
            $search_category = $requestData['category'];
            $search_date = $requestData['date'];
        }else{
            $search_status = 1;
            $search_category = -1;
            $search_date = -1;
        }
        $userId =  \Auth::user()->id;
        $proImagePath = $this->get_profile_img();
        $user_partner = UserPartners::where('user_id',$userId)->get()->toArray();
        $data['vendorCats'] = Category::select('id','title')->where([['parent_id','=',2],['status','=',1]])->limit(5)->get()->toArray();
        $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','40')->first();
        $data['cats'] = TodoListCategory::where('status','=','1')->get()->toArray();
        $data['dates'] = TodoListDate::where('status','=','1')->get()->toArray();

        ///////////////////////////////////////////////////////////////////////////////////////////////
        ######### Status use as a task status in todolist table #############
        $listedTasks = TodoList::select('id as list_id','title','description','todo_date_id','todo_cat_id','status as task_status')
        ->where('user_id','=','0')->orWhere('user_id','=',$userId)        
        ->get()->toArray();

        $answerTasks = TodoAnswerList::select('list_id','title','description','todo_date_id','todo_cat_id','task_status')
         ->where('user_id','=',$userId)      
        ->get()->toArray();

        if(isset($listedTasks) && !empty($listedTasks)){
            $answerTaskIds = array();
            if(isset($answerTasks) && !empty($answerTasks)){
                $answerTaskIds = array_column($answerTasks,'list_id');
                foreach($listedTasks as &$vval){
                    if(in_array($vval['list_id'],$answerTaskIds)){
                       $key = array_search($vval['list_id'], $answerTaskIds);
                       $vval['title'] = $answerTasks[$key]['title'];
                       $vval['description'] = $answerTasks[$key]['description'];
                       $vval['todo_date_id'] = $answerTasks[$key]['todo_date_id'];
                       $vval['todo_cat_id'] = $answerTasks[$key]['todo_cat_id'];
                       $vval['task_status'] = $answerTasks[$key]['task_status'];
                    }
                }
            }
        }
        //////////////////////////////////////////////////////////////////////////////////////////////

        $totalCounter = $pendingCount = $completeCount = 0;
        $holdCat = array();
        $holdFinalArray = array();
        $holdCatArray = array();
        if(isset($listedTasks) && !empty($listedTasks)){
           foreach($listedTasks as $task){
              if($task['task_status'] != 3){
                 $holdFinalArray[$task['todo_date_id']][] = $task;
                 $holdCatArray[] = $task['todo_cat_id'];
                 $totalCounter += 1;
                 if($task['task_status']==1){ $pendingCount += 1;}
                 if($task['task_status']==2){ $completeCount += 1;}
              }
           }
        }
        $data['tasks']['total'] = $totalCounter;
        $data['tasks']['pending'] = $pendingCount;
        $data['tasks']['complete'] = $completeCount;
        if($totalCounter!=0){
           $data['tasks']['percent'] = round(($completeCount * 100) / $totalCounter);
        }else{
           $data['tasks']['percent'] = 0;
        }
        $data['tasks']['full_data'] = $holdFinalArray;
        $data['tasks']['cat_data'] = array_count_values($holdCatArray);
       
        return view('tools.to_do_list',['pro_image'=>$proImagePath,'user_partner'=>$user_partner,'data'=>$data]);
    }

    /*
    *
    * Get Todo list task details
    *
    */

    public function todolist_task_details(Request $request){
        $listId = $request->input('taskid');
        if($listId){
          $userId =  \Auth::user()->id;
          $listDetails = TodoAnswerList::where([['user_id','=',$userId],['list_id','=',$listId]])->get()->toArray();
          if(!isset($listDetails) || empty($listDetails)){ // If not found in answer table then save first and return data
              $getTaskDetails = TodoList::where('id','=',$listId)->get()->toArray();
              $objAnsList = new TodoAnswerList;
              $objAnsList->user_id = $userId;
              $objAnsList->list_id = $listId;
              $objAnsList->title = $getTaskDetails[0]['title'];
              $objAnsList->description = $getTaskDetails[0]['description'];
              $objAnsList->todo_date_id = $getTaskDetails[0]['todo_date_id'];
              $objAnsList->todo_cat_id = $getTaskDetails[0]['todo_cat_id'];     
              $objAnsList->task_status = 1;
              $returnData = $objAnsList->save();
              $lastId = $objAnsList->id;
              if($returnData){
                $listDetails = TodoAnswerList::where('id','=',$lastId)->get()->toArray();
              }else{
                 redirect('tools/to-do-list');
              }
          }
          $data['taskVendorData'] = (object)array();
          $data['vendorCats'] = Category::select('id','title')->where([['parent_id','=',2],['status','=',1]])->limit(5)->get()->toArray();
          $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','40')->first();
          $data['cats'] = TodoListCategory::where('status','=','1')->get()->toArray();
          $data['dates'] = TodoListDate::where('status','=','1')->get()->toArray();
          $vendorList = VendorsForTask::select('vendor_id')->where('list_id','=',$listId)->where('user_id',$userId)->get()->toArray();
          if(isset($vendorList) && !empty($vendorList)){
              $vendorIds = array_column($vendorList,'vendor_id');
              $data['taskVendorData'] = DB::table('vendors')
                ->join('vendor_companies', 'vendors.vendor_id', '=', 'vendor_companies.vendor_id')
                ->join('vendor_images', 'vendors.vendor_id', '=', 'vendor_images.vendor_id')
                ->select('vendors.vendor_id','vendor_companies.city','vendor_companies.province', 'vendor_companies.business_name', 'vendor_companies.business_name_slug','vendor_images.vendor_folder','vendor_images.image')
                ->groupBy('vendor_images.vendor_folder')->whereIn('vendors.vendor_id',$vendorIds)->get();
          }
         /* echo"<pre>";
          print_r($data['vendorData']);
          die;*/
          $data['task_details'] = $listDetails;
          $data['summary'] = $this->getTodoCounter($userId);
          $data['list_id'] = $listId;
          return view('tools.task_details',['data'=>$data]);
        }else{
           return redirect('tools/to-do-list');
        }
    }

    public function todolist_task_remove($idx=null)
    {
        $dlt1 = TodoList::where('id',$idx)->delete();
        $dlt2 = TodoAnswerList::where('list_id',$idx)->delete();
        return redirect('tools/to-do-list')->with('message','<span class="alert alert-danger">Task has been deleted successfully.</span>');
        
    }

    public function getTodoCounter($userId){
        $cancelTasks = 0;
        $completeTasks = 0;
        $totalTasks = TodoList::where('user_id','=','0')->orWhere('user_id','=',$userId)->count();
        $answerTasks = TodoAnswerList::where('user_id','=',$userId)->get()->toArray();
        if(isset($answerTasks) && !empty($answerTasks)){
            $holdData = array_count_values(array_column($answerTasks,'task_status'));
            $cancelTasks = $holdData[3] ?? 0;
            $completeTasks = $holdData[2] ?? 0;
        }
        $returnArr['cancel_task'] = $cancelTasks;
        $returnArr['complete_task'] = $completeTasks;
        $returnArr['total_task'] = $totalTasks - $cancelTasks;
        $returnArr['percent_task'] = ($returnArr['complete_task'] * 100) / max($returnArr['total_task'],1);
        return $returnArr;
    }

    public function getTodoBookedVendors($userId){
         return  UserBookedVendor::select('user_booked_vendors.*','VC.id as cmpany_id','VC.business_name',
          'C1.title as cat_title','C1.id as cat_id','C2.title as parent_cat_title','C2.id as parent_cat_id')
          ->leftJoin('vendors as VN','user_booked_vendors.vendor_id','=','VN.vendor_id')
          ->leftJoin('categories as C1','VN.cat_id','=','C1.id')
          ->leftJoin('categories as C2','C1.parent_id','=','C2.id')
          ->leftJoin('vendor_companies as VC','VN.vendor_id','=','VC.vendor_id')
          ->where('user_booked_vendors.user_id','=',$userId)
          ->where('user_booked_vendors.book_status','=',6)
          ->get()->toArray();
         
    }

    /**
    * Save user task data
    * 
    */

    public function save_user_task(Request $request)
    {
        $this->validate($request, [
            'task_id' => 'required',
            'task_oper' => 'required|string',
        ],[ 'task_id.required'=>'Oops! Task is not identify.',
            'task_oper.required'=>'Oops! Task operation not found.',
        ]);
        $userId = \Auth::user()->id;
        // if pending (click on pending) then move to complete that's why pending set = 2 and complete also set 1
        $statusArray = array('pending'=>2,'complete'=>1,'delete'=>3);
        $list_id = $request->input('task_id');
        $getTaskDetails = TodoList::where('id','=',$list_id)->get()->toArray();
        $getAnsTask = TodoAnswerList::where(array('user_id' => $userId,'list_id'=>$list_id))->get()->toArray();
        if(isset($getAnsTask) && !empty($getAnsTask)) {
            $data =  TodoAnswerList::where('user_id', $userId)
            ->where('list_id', $list_id)
            ->update(['task_status' => $statusArray[$request->input('task_oper')]]);
        } else {
            $objAns1 = new TodoAnswerList;
            $objAns1->user_id = $userId;
            $objAns1->list_id = $list_id;
            $objAns1->title = $getTaskDetails[0]['title'];
            $objAns1->description = $getTaskDetails[0]['description'];
            $objAns1->todo_date_id = $getTaskDetails[0]['todo_date_id'];
            $objAns1->todo_cat_id = $getTaskDetails[0]['todo_cat_id'];     
            $objAns1->task_status = $statusArray[$request->input('task_oper')];
            $data = $objAns1->save();
        }
        if($data) {
            return response()->json([
                'errorVal' => false,
                'msg' => 'Action Successfully Done.'
            ],200);
        } else {
            return response()->json([
                'errorVal' => true,
                'msg' => 'Action Not Done.'
            ],422);
        }
    }

    /*
    * Save Own Task
    *
    */

    public function save_form_task(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'todo_cat_id' => 'required',
            'todo_date_id' => 'required',
        ],[ 'title.required'=>'Task title is required.',
            'description.required'=>'Task description is required.',
            'todo_cat_id.required'=>'Task category is required.',
            'todo_date_id.required'=>'Task start date is required.',
        ]);
        $userId =  \Auth::user()->id;
        $todoObj = new TodoList;
        $todoObj->user_id = $userId;
        $todoObj->title = $request->input('title');
        $todoObj->description = $request->input('description');
        $todoObj->todo_date_id = $request->input('todo_date_id');
        $todoObj->todo_cat_id = $request->input('todo_cat_id');
        $data = $todoObj->save();
        if($data){
            return \Redirect::back()->with('message','<span class="alert alert-success">Task has been created successfully.</span>');
        }else{ 
            return \Redirect::back()->with('message','<span class="alert alert-danger">Oops! Something went wrong please try again.</span>');
        }
    }

    /*
    *  Create Todo List CSV
    * 
    */
    public function todo_list_csv(){
        $currentDate = date('d_M_Y');
        \Excel::create('Todo_List_'.$currentDate, function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {
                $userId =  \Auth::user()->id;

                $data['cats'] = TodoListCategory::where('status','=','1')->get()->toArray();
                $data['dates'] = TodoListDate::where('status','=','1')->get()->toArray();
                $catsId = array_column($data['cats'],'title','id');
                $datesId = array_column($data['dates'],'title','id');
                
                $statusVal = array('1'=>'Pending','2'=>'Complete','3'=>'Cancel');

                $listedTasks1 = TodoList::select('id as list_id','todo_date_id as Start_date','todo_cat_id as Category','status as Task_status','Title','Description')
                    ->orderBy('todo_date_id','asc')
                    ->where('user_id','=','0')->orWhere('user_id','=',$userId)        
                    ->get()->toArray();

                $answerTasks = TodoAnswerList::select('list_id','todo_date_id as Start_date','todo_cat_id as Category','Task_status','Title','Description')
                     ->where('user_id','=',$userId)      
                    ->get()->toArray();

                if(isset($listedTasks1) && !empty($listedTasks1)){
                    $answerTaskIds = array();
                    if(isset($answerTasks) && !empty($answerTasks)){
                       $answerTaskIds = array_column($answerTasks,'list_id');
                    }
                    foreach($listedTasks1 as &$vval1){
                        if(in_array($vval1['list_id'],$answerTaskIds)){
                           $key = array_search($vval1['list_id'], $answerTaskIds);
                           $vval1['Start_date'] = $datesId[$answerTasks[$key]['Start_date']];
                           $vval1['Category'] = $catsId[$answerTasks[$key]['Category']];
                           $vval1['Task_status'] = $statusVal[$answerTasks[$key]['Task_status']];
                           $vval1['Title'] = $answerTasks[$key]['Title'];
                           $vval1['Description'] = $answerTasks[$key]['Description'];
                        }else{
                           $vval1['Start_date'] = $datesId[$vval1['Start_date']];
                           $vval1['Category'] = $catsId[$vval1['Category']];
                           $vval1['Task_status'] = $statusVal[$vval1['Task_status']];
                        }
                    }
                }

                $sheet->setOrientation('landscape');
                $sheet->fromArray($listedTasks1);
            });
        })->export('xlsx');
    }

    /*
    *
    * Checklist print
    *
    */

    public function get_ChecklistPrint() {

      $userId =  \Auth::user()->id;
      $data['user'] = \Auth::user();
      $data['list'] = TodoListDate::with(['getlist' => function($q) use ($userId) {
        $q->with('getcategory')->where('user_id','=','0')->orWhere('user_id', $userId);
      }])->get()->toArray();

      return view('tools.checklistprint', ['data'=>$data]);
    }

    /*
    * Booked Vendors
    *
    */

    public function booked_vendor(Request $request)
    {
        $this->validate($request, [
                'vendor_search_data' => 'required',
                'vendor_hired' => 'required',
            ]);
        $userId = \Auth::user()->id;
        $bookObj = UserBookedVendor::firstOrNew(array('user_id' => $userId,'vendor_id'=>$request->input('vendor_search_data')));
        $bookObj->user_id = $userId;
        $bookObj->vendor_id = $request->input('vendor_search_data');
        $bookObj->book_status = ($request->input('vendor_hired') == 1)? 6 : 3;
        $data = $bookObj->save();
        if($data) {
            return \Redirect()->back()->with('message','<span class="alert alert-success">Vendor has been saved successfully.</span>');
        } else { 
            return \Redirect::back()->with('message','<span class="alert alert-danger">Oops! Something went wrong please try again.</span>');
        }
    }

    /*
    * Add Vendor To Task
    *
    */
    public function add_vendor_to_task(Request $request)
    {
        $this->validate($request, [
                'vendor_search_data' => 'required',
                'vendor_hired' => 'required',
            ]);
        $userId =  \Auth::user()->id;
        $bookObj = UserBookedVendor::firstOrNew(array('user_id' => $userId,'vendor_id'=>$request->input('vendor_search_data')));
        $bookObj->user_id = $userId;
        $bookObj->vendor_id = $request->input('vendor_search_data');
        $bookObj->book_status = ($request->input('vendor_hired') == 1)? 6 : 3;
        $data = $bookObj->save();
        $listObj = VendorsForTask::firstOrNew(array('user_id' => $userId,'vendor_id'=>$request->input('vendor_search_data')));
        $listObj->user_id = $userId;
        $listObj->vendor_id = $request->input('vendor_search_data');
        $listObj->list_id = $request->input('list_id');
        $data = $listObj->save();
        if($data) {
            return \Redirect()->back()->with('message','<span class="alert alert-success">Vendor has been saved successfully.</span>');
        } else { 
            return \Redirect::back()->with('message','<span class="alert alert-danger">Oops! Something went wrong please try again.</span>');
        }
    }

    /**
     * Show the vendors
     *
     * @return \Illuminate\Http\Response
     */
    public function vendors()
    {
        $userId = \Auth::user()->id;
        $data = $this->getAllBookedVendor($userId);
        $data['totalCats'] = Category::where([['parent_id','=',2],['status','=',1]])->count();
        $parentCount = Category::where([['id','!=',2],['id','!=',39],['status','=',1],['is_parent','=',1]])->count();
        $data['totalCats'] = $data['totalCats'] + $parentCount; // Add For (Venues) / (Groom) / (Bride) Category
        $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','2')->first();
        $data['catImages'] = CategoryImages::get();
        return view('tools.vendors',['data'=>$data]);
    }

    public function getAllBookedVendor($userId)
    {
        $parentCounter = array();
        $childCounter = array();
        $totalSaved = UserBookedVendor::select('user_booked_vendors.*','VN.cat_id','CT.parent_id')->leftJoin('vendors as VN','user_booked_vendors.vendor_id','=','VN.vendor_id')
        ->leftJoin('categories as CT','VN.cat_id','=','CT.id')->where('user_booked_vendors.user_id','=',$userId)->get()->toArray();
        $allCatsData = Category::select('id','title','parent_id')->where([['parent_id','!=',0],['parent_id','!=',39],['status','=',1]])->get()->toArray();
        $bookData = UserBookedVendor::select('user_booked_vendors.*','V.cat_id','VC.business_name',
            DB::raw('(select concat(vendor_folder,"/",image) from vendor_images where vendor_images.vendor_id = V.vendor_id limit 1) as image'))
        ->leftJoin('vendors as V','user_booked_vendors.vendor_id','=','V.vendor_id')
        ->leftJoin('vendor_companies as VC','V.vendor_id','=','VC.vendor_id')
        ->where('user_booked_vendors.user_id','=',$userId)
        ->where('user_booked_vendors.book_status','=',6)
        ->groupBy('V.cat_id')->get()->toArray();
        $nonBookData = UserBookedVendor::select('user_booked_vendors.*','V.cat_id','VC.business_name',
            DB::raw('(select concat(vendor_folder,"/",image) from vendor_images where vendor_images.vendor_id = V.vendor_id limit 1) as image'))
        ->leftJoin('vendors as V','user_booked_vendors.vendor_id','=','V.vendor_id')
        ->leftJoin('vendor_companies as VC','V.vendor_id','=','VC.vendor_id')
        ->where('user_booked_vendors.user_id','=',$userId)
        ->where('user_booked_vendors.book_status','!=',6)
        ->groupBy('V.cat_id')->get()->toArray();
        if(isset($allCatsData) && !empty($allCatsData)){
            $counter  = 0;
            foreach($allCatsData as $key=>$cVal){
                $keyVal = array_search($cVal['id'],array_column($bookData,'cat_id'));
                if($keyVal !== false){
                   $allCatsData[$key]['booked'] = $bookData[$keyVal];
                }
                $keyVals = array_search($cVal['id'],array_column($nonBookData,'cat_id'));
                if($keyVals !== false){
                   $allCatsData[$key]['nonBooked'] = $nonBookData[$keyVals];
                }
                $newArrayVale[$cVal['parent_id']][$key] = $allCatsData[$key];
            }
        }
        /////////// Get Saved Vendor By Cat ////////////
        if(isset($totalSaved) && !empty($totalSaved)){
            $parentCounter = array_count_values(array_column($totalSaved,'parent_id'));
            $childCounter = array_count_values(array_column($totalSaved,'cat_id'));
        }
        ///////////////////////////////////////////////
        $returnData['totalSaved'] = count($totalSaved);
        $returnData['vendorCats'] = $newArrayVale;
        $returnData['booked_vendors'] = count($bookData);
        $returnData['parent_counter'] = $parentCounter;
        $returnData['child_counter'] = $childCounter;
        return $returnData;
    }

    public function vendors_category(Request $request)
    {
        $data['cat_id'] = $catId = $request->input('id_categ');
        $data['status'] = $status = $request->input('status');
        $data['status_counter'] = array();
        $userId =  \Auth::user()->id;
        $query = DB::table('user_booked_vendors as UBV')->select('UBV.*','VN.vendor_id','VN.telephone as v_telephone','VN.email as v_email','CT.id as cat_id','CT.title as cat_name','CT.slug as cat_slug','CT1.id as cat_parent_id','CT1.title as cat_parent_name','CT1.slug as cat_parent_slug','VC.id as business_id','VC.business_name','VC.business_name_slug','VC.city')
        ->leftJoin('vendors as VN','UBV.vendor_id','=','VN.vendor_id')
        ->leftJoin('vendor_companies as VC','VN.vendor_id','=','VC.vendor_id')
        ->leftJoin('categories as CT','VN.cat_id','=','CT.id')
        ->leftJoin('categories as CT1','CT.parent_id','=','CT1.id')
        ->where('UBV.user_id','=',$userId);
        if(isset($catId) && $catId !='' && $catId != null) {
            $getCatParent = Category::select(DB::raw('GROUP_CONCAT(id) as ids'))->where([['is_parent','=',"0"],['parent_id','=',$catId]])->get()->toArray();
            if(isset($getCatParent[0]['ids']) && $getCatParent[0]['ids'] !=''){
               $catIdArray = explode(',',$getCatParent[0]['ids']);
               $query->whereIn('CT.id',$catIdArray);
            } else {
               $query->where('CT.id','=',$catId);
            }
        }
        if(isset($status) && $status !='' && $status != null){
            $query->where('UBV.book_status','=',$status);
        }
        $data['vendors'] = $query->get()->toArray();
        if(isset($data['vendors']) && !empty($data['vendors'])){
            $data['status_counter'] = array_count_values(array_column($data['vendors'],'book_status'));
            foreach($data['vendors'] as $keyyy=>$vdataa){
               $datas = \App\Vendor::with('image_data','rating_data')->where('vendor_id','=',$vdataa->vendor_id)->get()->toArray();
               $vdataa->image_date = $datas[0]['image_data'];
               $vdataa->rating_data = $datas[0]['rating_data'];
            }
        }
        switch($catId){
            case '':
             $data['search_cat'] = 'All';
             break;
            case 1:
             $data['search_cat'] = 'Reception';
             break;
            case 3:
             $data['search_cat'] = 'Bridal Accessories';
             break;
            case 4:
             $data['search_cat'] = "Groom's Accessories";
             break;
            default:
            $catData = Category::select('title')->where('id','=',$catId)->first();
            $data['search_cat'] = str_replace('Wedding', '', $catData->title);
            break;
        }
        $data['sideBar'] = $this->getAllBookedVendorSideBar($userId);
        $catId = $catId ?? 2;
        $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=',$catId)->first();
        if($catId) {
            $data['category'] = DB::table('categories as CT')->select('CT.id as cat_id','CT.title as cat_name','CT.slug as cat_slug','CT1.title as cat_parent_name','CT1.slug as cat_parent_slug')
                ->leftJoin('categories as CT1','CT.parent_id','=','CT1.id')->where('CT.id','=',$catId)->get();
        } else {
            $data['category'] = array();
        }
        $data['catImages'] = CategoryImages::get();
        return view('tools.vendors_category',['data'=>$data]);
    }

    public function getAllBookedVendorSideBar($userId){
        $parentCounter = array();
        $childCounter = array();
        $totalSaved = UserBookedVendor::select('user_booked_vendors.*','VN.cat_id','CT.parent_id')->leftJoin('vendors as VN','user_booked_vendors.vendor_id','=','VN.vendor_id')
        ->leftJoin('categories as CT','VN.cat_id','=','CT.id')->where('user_booked_vendors.user_id','=',$userId)->get()->toArray();
        $allCatsData = Category::select('id','title','parent_id')->where([['parent_id','!=',0],['parent_id','!=',39],['status','=',1]])->get()->toArray();
        $bookData = UserBookedVendor::select('user_booked_vendors.*','V.cat_id','VC.business_name',
            DB::raw('(select concat(vendor_folder,"/",image) from vendor_images where vendor_images.vendor_id = V.vendor_id limit 1) as image'))
        ->leftJoin('vendors as V','user_booked_vendors.vendor_id','=','V.vendor_id')
        ->leftJoin('vendor_companies as VC','V.vendor_id','=','VC.vendor_id')
        ->where('user_booked_vendors.user_id','=',$userId)
        ->where('user_booked_vendors.book_status','=',6)
        ->groupBy('V.cat_id')->get()->toArray();
        if(isset($allCatsData) && !empty($allCatsData)){
            $counter  = 0;
            foreach($allCatsData as $key=>$cVal){
                $keyVal = array_search($cVal['id'],array_column($bookData,'cat_id'));
                if($keyVal !== false){
                   $allCatsData[$key]['booked'] = $bookData[$keyVal];
                }
                $newArrayVale[$cVal['parent_id']][$key] = $allCatsData[$key];
            }
        }
        /////////// Get Saved Vendor By Cat ////////////
        if(isset($totalSaved) && !empty($totalSaved)){
          $parentCounter = array_count_values(array_column($totalSaved,'parent_id'));
          $childCounter = array_count_values(array_column($totalSaved,'cat_id'));
        }

        ///////////////////////////////////////////////
        $returnData['totalSaved'] = count($totalSaved);
        $returnData['vendorCats'] = $newArrayVale;
        $returnData['booked_vendors'] = count($bookData);
        $returnData['parent_counter'] = $parentCounter;
        $returnData['child_counter'] = $childCounter;
        return $returnData;
    }

    public function remove_booked_vendor($id){
        $userId =  \Auth::user()->id;
        if($id){
              UserBookedVendor::destroy($id);
              return \Redirect()->back()->with('message','<span class="alert alert-success">Vendor has been removed successfully.</span>');
        }else{ 
             return \Redirect::back()->with('message','<span class="alert alert-danger">Oops! Something went wrong please try again.</span>');
        }
    }

    public function udpate_saved_vendor_data(Request $request){
        if($request->input('id')){
            $field = $request->input('fields');
            $data = $request->input('data');
            $objBooked = UserBookedVendor::find($request->input('id'));
            $objBooked->$field = $data;
            $objBooked->save();
            return response()->json([
                     'errorVal' => false,
                     'msg' => 'Action Successfully Done.'
            ],200);
         }else{
            return response()->json([
                     'errorVal' => true,
                     'msg' => 'Action Not Done.'
                 ],422);
         }
    }

  public function udpate_todo_list(Request $request){
        if($request->input('id')){
            $field = $request->input('fields');
            $data = $request->input('data');
            $objTodo = TodoAnswerList::find($request->input('id'));
            $objTodo->$field = $data;
            $objTodo->save();
            return response()->json([
                     'errorVal' => false,
                     'msg' => 'Action Successfully Done.'
            ],200);
         }else{
            return response()->json([
                     'errorVal' => true,
                     'msg' => 'Action Not Done.'
                 ],422);
         }
    }

   /**
   * Show the dresses
   *
   * @return \Illuminate\Http\Response
   */

    public function get_dresses()
    {
        $userId =  \Auth::user()->id;
        $wishLists = $this->getWishLists();
        $data['dresses'] = $this->get_dresses_data(27);
        $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','27')->first();
        return view('tools.dresses',['data'=>$data,'wishLists'=>$wishLists]);
    }

    /*
    *
    * get dresses data
    *
    */

    public function get_dresses_data($cat_id){
        $query = Vendor::select('vendor_id','email','cat_id');
        $query->where('vendors.cat_id',$cat_id);
        $query->where('vendors.status',1);
        $query->where('vendors.step_completed',4);
        $query->with('image_data','company_data');
       return $vendorData = $query->with(array('category_data'=>function($query){
           $query->select('categories.id','categories.slug','cat.slug as parent_slug','cat.title as parent_title','categories.title','categories.parent_id','categories.meta_title','categories.meta_keyword','categories.meta_description')->join('categories AS cat', 'cat.id', '=', 'categories.parent_id');
        }))->get()->toArray();
    }

    protected function getWishLists(){
        $wishList = array();
        $isLoginUser = \Auth::user();
        if(isset($isLoginUser) && !empty($isLoginUser)){
           $wishList = \App\Wishlist::where('user_id',$isLoginUser->id)->get()->toArray();
           if(isset($wishList) && !empty($wishList)){
             $wishList = array_column($wishList,'company_id');
           }
        }
        return $wishList;
    }

   /**
   * Show the Guests
   *
   * @return \Illuminate\Http\Response
   */
    public function guests_old_page(Request $request)
    {
        $userId = \Auth::user()->id;
        $coupleList = GuestsList::where('user_id',$userId)->where('group_id',1)->get()->count();
        if(!$coupleList){
            $weddingData = UserPartners::where('user_id',$userId)->get()->toArray();
            if(isset($weddingData) && !empty($weddingData)){
                $guestList[0]['user_id'] = $userId;
                $guestList[0]['name'] = $weddingData[0]['name'];
                $guestList[0]['gender'] = ($weddingData[0]['gender']=='groom')?'male':'female';
                $guestList[0]['group_id'] = 1; // 1 for couple
                $guestList[0]['attendance'] = 'confirmed';
                $guestList[0]['age_type'] = 'adult';
                $guestList[0]['menu'] = 'adult';
                $guestList[1]['user_id'] = $userId;
                $guestList[1]['name'] = $weddingData[0]['partner_name'];
                $guestList[1]['gender'] = ($weddingData[0]['partner_gender']=='groom')?'male':'female';
                $guestList[1]['group_id'] = 1; // 1 for couple
                $guestList[1]['attendance'] = 'confirmed';
                $guestList[1]['age_type'] = 'adult';
                $guestList[1]['menu'] = 'adult';
                GuestsList::insert($guestList);
            }else{
                $gender = \Auth::user()->event_role;
                if($gender == null || $gender =='' || $gender == 'groom') {
                    $gender1= 'male'; $gender2='female';
                } else {
                    $gender1= 'female'; $gender2='male';
                }
                $guestList[0]['user_id'] = $userId;
                $guestList[0]['name'] = \Auth::user()->name;
                $guestList[0]['gender'] = $gender1;
                $guestList[0]['group_id'] = 1; // 1 for couple
                $guestList[0]['attendance'] = 'confirmed';
                $guestList[0]['age_type'] = 'adult';
                $guestList[0]['menu'] = 'adult';
                $guestList[1]['user_id'] = $userId;
                $guestList[1]['name'] = $gender2;
                $guestList[1]['gender'] = $gender2;
                $guestList[1]['group_id'] = 1; // 1 for couple
                $guestList[1]['attendance'] = 'confirmed';
                $guestList[1]['age_type'] = 'adult';
                $guestList[1]['menu'] = 'adult';
                GuestsList::insert($guestList);
            }
        }
        $newArray = array();
        $data['guestListData'] = GuestsList::select('guests_lists.*','GC.title as cat_title')->leftJoin('guests_categories as GC','guests_lists.group_id','=','GC.id')->where('guests_lists.user_id',$userId)->orderBy('guests_lists.group_id','asc')->get()->toArray();
        if(isset($data['guestListData']) && !empty($data['guestListData'])) {
            $data['total_guest'] = count($data['guestListData']);
            $data['attendace'] = array_count_values(array_column($data['guestListData'],'attendance'));
            $data['ages'] = array_count_values(array_column($data['guestListData'],'age_type'));
            $data['menu'] = array_count_values(array_column($data['guestListData'],'menu'));
            $data['groups'] = array_count_values(array_column($data['guestListData'],'group_id'));
            foreach($data['guestListData'] as $guestData) {
                if($request->type == 'menus') {
                    $newArray[$guestData['menu']][] = $guestData;
                } else if($request->type == 'attendance') {
                    $newArray[$guestData['attendance']][] = $guestData;
                } else {
                    $newArray[$guestData['cat_title']][] = $guestData;
                }
            }
        }
        $data['guestListData'] = $newArray;
        $data['tab'] = ($request->type)?$request->type:'groups';
        $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','41')->first();
        $data['guestsCat'] = \App\GuestsCategory::where('user_id',$userId)->where('status','=','1')->get()->toArray();
        $data['countries'] = \App\Countries::where('status','=',1)->get()->toArray();

        return view('tools.guests_old_page',['data'=>$data]);
    }

    public function get_guests(Request $request)
    {
        $userId = \Auth::user()->id;
        $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','41')->first();
        $newArray = array();
        $data['guestListData'] = GuestsListNew::with(['guestsInvitation'])->select('guests_lists_new.*','GC.id as cat_id','GC.title as cat_title')->leftJoin('guests_categories as GC','guests_lists_new.group_id','=','GC.id')->where('guests_lists_new.user_id',$userId)->orderBy('guests_lists_new.group_id','asc')->get();
        $data['unassignGuest'] = GuestsListNew::with(['guestsInvitation'])->select('guests_lists_new.*')->where('guests_lists_new.user_id',$userId)->where('guests_lists_new.group_id',NULL)->orderBy('guests_lists_new.id','asc')->get();
        $data['guestsCat'] = GuestsCategory::with(['groupCount'])->where('user_id',$userId)->where('status','=','1')->get();
        $data['guests_event_limit'] = GuestsEvent::with(['guestsInvitationCount'])->where('user_id',$userId)->orderBy('id','ASC')->limit(3)->get();
        $data['guests_event'] = GuestsEvent::with(['guestsInvitationCount'])->where('user_id',$userId)->get();
        ////// Fetch event Data on change-event......
        $tab = @$request->tab;
        $idEvent = @$request->idEvent;
        $idGuest = @$request->idGuest;
        $viewGrid = @$request->viewGrid;
        $data['current_event'] = array();
        $data['editGuest'] = array();
        $data['menusCat'] = array();
        $data['unassignMenu'] = array();
        $data['tablesCat'] = array();
        $data['unassignTable'] = array();
        $data['attendanceCat'] = array();
        $data['listsCat'] = array();
        $data['unassignList'] = array();
        if($idEvent) {
            ////// For Edit Guest Div......
            if($idGuest != '' && $viewGrid == 2) {
                $data['editGuest'] = GuestsListNew::leftJoin('guests_invitation_events as GI','GI.guest_id','=','guests_lists_new.id')
                                    ->leftJoin('guests_categories as GC','GC.id','=','guests_lists_new.group_id')
                                    ->leftJoin('guests_events as GE','GE.id','=','GI.invited_for')
                                    ->leftJoin('seating_chart as SA','SA.id','=','GI.tables')
                                    ->select('guests_lists_new.*','GC.title','GE.id as event_id','GE.event_name','GE.tables as eTable','GE.menus as eMenu','GE.menu_types','GE.lists as eList','GE.list_types','GI.id as invId','GI.invited_for','GI.attendances','GI.tables','GI.menus','GI.lists','SA.table_nm','SA.id as tblId','SA.table_seat',DB::raw('(select count(seat_id) from seat_arrangements where seat_arrangements.chart_table_id = SA.id limit 1) as guest_seat'))
                                    ->where('GI.guest_id',$idGuest)->where('guests_lists_new.id',$idGuest)->orderBy('GI.id','ASC')->get();
                foreach($data['editGuest'] as $nm => $vls) {
                    if($vls->related_id) {
                        $rCompanion = GuestsListNew::where('id',$vls->related_id)->first();
                        $data['editGuest'][$nm]['rCompanion'] = $rCompanion;
                    } else {
                        $companion = GuestsListNew::where('related_id',$vls->id)->get();
                        $data['editGuest'][$nm]['companion'] = $companion;
                    }
                }
            }
            ////// For Group Tab......
            $data['current_event'] = GuestsEvent::with(['guestsInvitationCount'])->where('id',$idEvent)->first();
            $data['unassignGuest'] = GuestsListNew::leftJoin('guests_invitation_events as GI','GI.guest_id','=','guests_lists_new.id')
                                    ->leftJoin('seating_chart as SA','SA.id','=','GI.tables')
                                    ->select('guests_lists_new.*','GI.id as invId','GI.invited_for','GI.attendances','GI.tables','GI.menus','GI.lists','SA.table_nm as title','SA.id as tblId','SA.table_seat',DB::raw('(select count(seat_id) from seat_arrangements where seat_arrangements.chart_table_id = SA.id limit 1) as guest_seat'))
                                    ->where('GI.invited_for',$idEvent)->where('guests_lists_new.group_id',NULL)->get();
            $data['guestsCat'] = GuestsCategory::where('user_id',$userId)->where('status','1')->get();
            foreach($data['guestsCat'] as $nm => $vls) {
                $guestsData = GuestsListNew::leftJoin('guests_invitation_events as GI','GI.guest_id','=','guests_lists_new.id')
                            ->leftJoin('seating_chart as SA','SA.id','=','GI.tables')
                            ->select('guests_lists_new.*','GI.id as invId','GI.invited_for','GI.attendances','GI.tables','GI.menus','GI.lists','SA.table_nm as title','SA.id as tblId','SA.table_seat',DB::raw('(select count(seat_id) from seat_arrangements where seat_arrangements.chart_table_id = SA.id limit 1) as guest_seat'))
                            ->where('guests_lists_new.group_id',$vls->id)->where('GI.invited_for',$idEvent)->get();
                $data['guestsCat'][$nm]['guestsData'] = $guestsData;
            }
            ////// For Menu Tab......
            $eventMenus = explode('--',$data['current_event']->menu_types);
            $data['unassignMenu'] = GuestsListNew::leftJoin('guests_invitation_events as GI','GI.guest_id','=','guests_lists_new.id')
                                    ->leftJoin('seating_chart as SA','SA.id','=','GI.tables')
                                    ->select('guests_lists_new.*','GI.id as invId','GI.invited_for','GI.attendances','GI.tables','GI.menus','GI.lists','SA.table_nm as title','SA.id as tblId','SA.table_seat',DB::raw('(select count(seat_id) from seat_arrangements where seat_arrangements.chart_table_id = SA.id limit 1) as guest_seat'))
                                    ->where('GI.invited_for',$idEvent)->where('GI.menus',NULL)->get();
            for($emn = 0; $emn < count($eventMenus); $emn++) {
                $mGuestData = GuestsListNew::leftJoin('guests_invitation_events as GI','GI.guest_id','=','guests_lists_new.id')
                            ->leftJoin('seating_chart as SA','SA.id','=','GI.tables')
                            ->select('guests_lists_new.*','GI.id as invId','GI.invited_for','GI.attendances','GI.tables','GI.menus','GI.lists','SA.table_nm as title','SA.id as tblId','SA.table_seat',DB::raw('(select count(seat_id) from seat_arrangements where seat_arrangements.chart_table_id = SA.id limit 1) as guest_seat'))
                            ->where('GI.invited_for',$idEvent)->where('GI.menus',$eventMenus[$emn])->get();
                $data['menusCat'][$emn]['guestData'] = $mGuestData;
                $data['menusCat'][$emn]['title'] = $eventMenus[$emn];
            }
            ////// For Table Tab......
            $data['eventTable'] = SeatingChart::with(['seatdata'])->where('user_id',$userId)->where('event_id',$idEvent)->where('table_type','!=','noSeats')->get();
            $data['unassignTable'] = GuestsListNew::leftJoin('guests_invitation_events as GI','GI.guest_id','=','guests_lists_new.id')
                                    ->leftJoin('seating_chart as SA','SA.id','=','GI.tables')
                                    ->select('guests_lists_new.*','GI.id as invId','GI.invited_for','GI.attendances','GI.tables','GI.menus','GI.lists','SA.table_nm as title','SA.id as tblId','SA.table_seat',DB::raw('(select count(seat_id) from seat_arrangements where seat_arrangements.chart_table_id = SA.id limit 1) as guest_seat'))
                                    ->where('GI.invited_for',$idEvent)->where('GI.tables',NULL)->get();
            $data['tablesCat'] = SeatingChart::with(['seatdata'])->where('user_id',$userId)->where('event_id',$idEvent)->where('table_type','!=','noSeats')->get();
            foreach($data['tablesCat'] as $tnm => $etb) {
                $tGuestData = GuestsListNew::leftJoin('guests_invitation_events as GI','GI.guest_id','=','guests_lists_new.id')
                                ->select('guests_lists_new.*','GI.id as invId','GI.invited_for','GI.attendances','GI.tables','GI.menus','GI.lists')
                                ->where('GI.invited_for',$idEvent)->where('GI.tables',$etb->id)->get();
                $data['tablesCat'][$tnm]['guestData'] = $tGuestData;
            }
            ////// For Attendance Tab......
            $attndStats = 'confirmed';
            for($ats = 0; $ats < 3; $ats++) {
                if($ats == 1) {
                    $attndStats = 'pending';
                } elseif($ats == 2) {
                    $attndStats = 'cancelled';
                }
                $aGuestData = GuestsListNew::leftJoin('guests_invitation_events as GI','GI.guest_id','=','guests_lists_new.id')
                            ->leftJoin('seating_chart as SA','SA.id','=','GI.tables')
                            ->select('guests_lists_new.*','GI.id as invId','GI.invited_for','GI.attendances','GI.tables','GI.menus','GI.lists','SA.table_nm as title','SA.id as tblId','SA.table_seat',DB::raw('(select count(seat_id) from seat_arrangements where seat_arrangements.chart_table_id = SA.id limit 1) as guest_seat'))
                            ->where('GI.invited_for',$idEvent)->where('GI.attendances',$attndStats)->get();
                $data['attendanceCat'][$ats]['guestData'] = $aGuestData;
                $data['attendanceCat'][$ats]['title'] = ucfirst($attndStats);
            }
            ////// For List Tab......
            $eventLists = explode('--',$data['current_event']->list_types);
            $data['unassignList'] = GuestsListNew::leftJoin('guests_invitation_events as GI','GI.guest_id','=','guests_lists_new.id')
                                    ->leftJoin('seating_chart as SA','SA.id','=','GI.tables')
                                    ->select('guests_lists_new.*','GI.id as invId','GI.invited_for','GI.attendances','GI.tables','GI.menus','GI.lists','SA.table_nm as title','SA.id as tblId','SA.table_seat',DB::raw('(select count(seat_id) from seat_arrangements where seat_arrangements.chart_table_id = SA.id limit 1) as guest_seat'))
                                    ->where('GI.invited_for',$idEvent)->where('GI.lists',NULL)->get();
            for($eln = 0; $eln < count($eventLists); $eln++) {
                $lGuestData = GuestsListNew::leftJoin('guests_invitation_events as GI','GI.guest_id','=','guests_lists_new.id')
                                ->leftJoin('seating_chart as SA','SA.id','=','GI.tables')
                                ->select('guests_lists_new.*','GI.id as invId','GI.invited_for','GI.attendances','GI.tables','GI.menus','GI.lists','SA.table_nm as title','SA.id as tblId','SA.table_seat',DB::raw('(select count(seat_id) from seat_arrangements where seat_arrangements.chart_table_id = SA.id limit 1) as guest_seat'))
                                ->where('GI.invited_for',$idEvent)->where('GI.lists',$eventLists[$eln])->get();
                $data['listsCat'][$eln]['guestData'] = $lGuestData;
                $data['listsCat'][$eln]['title'] = $eventLists[$eln];
            }
        }
        // echo "<pre>"; print_r($data['guestsCat']); die;
        return view('tools.guests',['data'=>$data]);
    }

    public function download_guestList(Request $request)
    {
        $idEvent = @$request->idEvent;
        $currentDate = date('d_M_Y');
        \Excel::create('Guest_List_'.$currentDate, function($excel) use($idEvent) {
            $excel->sheet('Excel sheet', function($sheet) use($idEvent) {
                $userId = \Auth::user()->id;
                $guestList = GuestsListNew::select('GC.title as Group','guests_lists_new.firstname as First Name','guests_lists_new.lastname as Last Name','GE.attendances as Attendance','GE.menus as Menu','guests_lists_new.age_type as Age','guests_lists_new.gender as Gender','guests_lists_new.email as Email Id','guests_lists_new.phone_no as Phone','guests_lists_new.city_town as City','guests_lists_new.address as Address','guests_lists_new.postal_code as Postal Code','guests_lists_new.country as Country')->leftJoin('guests_categories as GC','guests_lists_new.group_id','=','GC.id')->leftJoin('guests_invitation_events as GE','guests_lists_new.id','=','GE.guest_id')->where('guests_lists_new.user_id',$userId)->where('GE.invited_for',$idEvent)->orderBy('guests_lists_new.group_id','asc')->get()->toArray();
                $sheet->setOrientation('landscape');
                $sheet->fromArray($guestList);
            });
        })->export('xlsx');
    }

    public function add_guest(Request $request)
    {
        $userId = \Auth::user()->id;
        $needHotel = 'No';
        if(@$request->need_hotel) {
            if($request->need_hotel == 'on' || $request->need_hotel == 'true') {
                $needHotel = 'Yes';
            }
        }
        $newGuests = new GuestsListNew;
        $newGuests->user_id     = $userId;
        $newGuests->firstname   = $request->firstname;
        $newGuests->lastname    = $request->lastname;
        $newGuests->age_type    = $request->age_type;
        $newGuests->gender      = $request->gender;
        $newGuests->group_id    = $request->group_id;
        $newGuests->need_hotel  = $needHotel;
        $newGuests->email       = $request->email;
        $newGuests->phone_no    = $request->phone_no;
        $newGuests->mobile_no   = $request->mobile_no;
        $newGuests->address     = $request->address;
        $newGuests->city_town   = $request->city_town;
        $newGuests->country     = $request->country;
        $newGuests->postal_code = $request->postal_code;
        $newGuests->save();
        if($newGuests->id) {
            $invFor = '1';
            if($request->eventId) {
                $invFor = $request->eventId;
            }
            if(@$request->invited_for) {
                foreach ($request->invited_for as $in => $vls) {
                    if($request->invited_for[$in] == 'on' || $request->invited_for[$in] == 'true') {
                        $invFor = $in;
                    }
                    $newInvitation = new GuestsInvitationEvents;
                    $newInvitation->guest_id    = $newGuests->id;
                    $newInvitation->invited_for = $invFor;
                    $newInvitation->attendances = 'pending';
                    $newInvitation->save();
                }
            } else {
                $newInvitation = new GuestsInvitationEvents;
                $newInvitation->guest_id    = $newGuests->id;
                $newInvitation->invited_for = $invFor;
                $newInvitation->attendances = 'pending';
                $newInvitation->save();
            }
            ////// For Related Guests insertion......
            if(@$request->firstnames) {
                foreach ($request->firstnames as $n => $vl) {
                    $relatedGuests = new GuestsListNew;
                    $relatedGuests->user_id     = $userId;
                    $relatedGuests->related_id  = $newGuests->id;
                    $relatedGuests->firstname   = $request->firstnames[$n];
                    $relatedGuests->lastname    = $request->lastnames[$n];
                    $relatedGuests->group_id    = $request->group_id;
                    $relatedGuests->need_hotel  = $needHotel;
                    $relatedGuests->country     = $request->country;
                    $relatedGuests->save();
                    if($relatedGuests->id) {
                        if(@$request->invited_for) {
                            foreach ($request->invited_for as $in => $vls) {
                                if($request->invited_for[$in] == 'on' || $request->invited_for[$in] == 'true') {
                                    $invFor = $in;
                                }
                                $newInvitation = new GuestsInvitationEvents;
                                $newInvitation->guest_id    = $relatedGuests->id;
                                $newInvitation->invited_for = $invFor;
                                $newInvitation->attendances = 'pending';
                                $newInvitation->save();
                            }
                        } else {
                            $newInvitation = new GuestsInvitationEvents;
                            $newInvitation->guest_id    = $relatedGuests->id;
                            $newInvitation->invited_for = $invFor;
                            $newInvitation->attendances = 'pending';
                            $newInvitation->save();
                        }
                    }
                }
            }
        }
        echo 'inserted';
    }

    public function edit_guest(Request $request)
    {
        $idGuest = $request->idGuest;
        $vals = $request->vals;
        $colName = $request->colName;
        $updGuest = GuestsListNew::find($idGuest);
        $updGuest->$colName = $vals;
        $updGuest->save();
        if($updGuest->id) {
            if($colName == 'group_id') {
                $groupData = GuestsCategory::where('id',$vals)->first();
                echo $groupData->title;
            } else {
                echo 'updated';
            }
        }
    }

    public function remove_guest(Request $request)
    {
        $idGuest = $request->idGuestModal;
        $selectedGuestsId = $request->selectedGuestsId;
        if($idGuest) {
            $delt1 = GuestsListNew::where('id',$idGuest)->delete();
            $delt2 = SeatArrangement::where('gust_id',$idGuest)->delete();
            $delt3 = GuestsInvitationEvents::where('guest_id',$idGuest)->delete();
        } else if($selectedGuestsId) {
            $selectedGuestsIds = explode('--',$selectedGuestsId);
            for($nm = 0; $nm < count($selectedGuestsIds); $nm++) {
                $delt1 = GuestsListNew::where('id',$selectedGuestsIds[$nm])->delete();
                $delt2 = SeatArrangement::where('gust_id',$selectedGuestsIds[$nm])->delete();
                $delt3 = GuestsInvitationEvents::where('guest_id',$selectedGuestsIds[$nm])->delete();
            }
        }
        return \Redirect()->back();
    }

    public function guests_companion_add_new(Request $request)
    {
        $userId = \Auth::user()->id;
        $idGuest = $request->idGuest;
        $idEvent = $request->idEvent;
        $parentData = GuestsListNew::where('id',$idGuest)->first();
        $relatedGuests = new GuestsListNew;
        $relatedGuests->user_id     = $userId;
        $relatedGuests->related_id  = $idGuest;
        $relatedGuests->firstname   = $request->firstname;
        $relatedGuests->lastname    = $request->lastname;
        $relatedGuests->age_type    = $request->age_type;
        $relatedGuests->gender      = $request->gender;
        $relatedGuests->group_id    = $parentData->group_id;
        $relatedGuests->need_hotel  = 'No';
        $relatedGuests->country     = $parentData->country;
        $relatedGuests->save();
        if($relatedGuests->id) {
            $newInvitation = new GuestsInvitationEvents;
            $newInvitation->guest_id    = $relatedGuests->id;
            $newInvitation->invited_for = $idEvent;
            $newInvitation->menus       = $request->menu_types;
            $newInvitation->attendances = 'pending';
            $newInvitation->save();
            if($newInvitation->id) {
                echo "done";
            }
        }
    }

    public function guests_companion_remove(Request $request)
    {
        $guestId = $request->idx;
        $guestType = $request->guestType;
        if($guestType == 'compGuest') {
            $delt1 = GuestsListNew::where('id',$guestId)->delete();
            $delt2 = GuestsInvitationEvents::where('guest_id',$guestId)->delete();
        } elseif($guestType == 'mainGuest') {
            $mainData = GuestsListNew::where('related_id',$guestId)->get();
            foreach($mainData as $mg) {
                $mainUpd = GuestsListNew::find($mg->id);
                $mainUpd->related_id = NULL;
                $mainUpd->save();
            }
            $delt1 = GuestsListNew::where('id',$guestId)->delete();
            $delt2 = GuestsInvitationEvents::where('guest_id',$guestId)->delete();
        }
        if($guestId) {
            echo "deleted";
        }
    }

    public function moveToGroups(Request $request)
    {
        $groupId = $request->groupId;
        $groupGuestsId = $request->groupGuestsId;
        $guestsIds = explode('--',$groupGuestsId);
        for($nm = 0; $nm < count($guestsIds); $nm++) {
            $guestList = GuestsListNew::find($guestsIds[$nm]);
            if($groupId == 0) {
                $guestList->group_id = NULL;
            } else {
                $guestList->group_id = $groupId;
            }
            $guestList->save();
        }
        if($groupId != '' || $groupGuestsId != '') {
            return \Redirect::back();
        }
    }

    public function moveToAttendance(Request $request)
    {
        $idEvent = $request->idEvent;
        $attendanceId = strtolower($request->attendanceId);
        $attendanceGuestsId = $request->attendanceGuestsId;
        $attendanceGuestsIds = explode('--',$attendanceGuestsId);
        for($nm = 0; $nm < count($attendanceGuestsIds); $nm++) {
            $guestData = GuestsInvitationEvents::where('guest_id',$attendanceGuestsIds[$nm])->where('invited_for',$idEvent)->get();
            foreach($guestData as $gds) {
                $guestInvite = GuestsInvitationEvents::find($gds->id);
                $guestInvite->attendances = $attendanceId;
                $guestInvite->save();
            }
        }
        if($idEvent != '' || $attendanceId != '') {
            return \Redirect::back();
        }
    }

    public function moveToMenus(Request $request)
    {
        $idEvent = $request->idEvent;
        $menusId = $request->menusId;
        $menusGuestsId = $request->menusGuestsId;
        $menusGuestsIds = explode('--',$menusGuestsId);
        for($nm = 0; $nm < count($menusGuestsIds); $nm++) {
            $guestData = GuestsInvitationEvents::where('guest_id',$menusGuestsIds[$nm])->where('invited_for',$idEvent)->get();
            foreach($guestData as $gds) {
                $guestInvite = GuestsInvitationEvents::find($gds->id);
                $guestInvite->menus = $menusId;
                $guestInvite->save();
            }
        }
        if($idEvent != '' || $menusId != '') {
            return \Redirect::back();
        }
    }

    public function moveToLists(Request $request)
    {
        $idEvent = $request->idEvent;
        $listsId = $request->listsId;
        $listsGuestsId = $request->listsGuestsId;
        $listsGuestsIds = explode('--',$listsGuestsId);
        for($nm = 0; $nm < count($listsGuestsIds); $nm++) {
            $guestData = GuestsInvitationEvents::where('guest_id',$listsGuestsIds[$nm])->where('invited_for',$idEvent)->get();
            foreach($guestData as $gds) {
                $guestInvite = GuestsInvitationEvents::find($gds->id);
                $guestInvite->lists = $listsId;
                $guestInvite->save();
            }
        }
        if($idEvent != '' || $listsId != '') {
            return \Redirect::back();
        }
    }

    public function add_group(Request $request)
    {
        $userId = \Auth::user()->id;
        $idGroup = $request->idGroup;
        $chkData = GuestsCategory::where('title',$request->group_name)->where('user_id',$userId)->count();
        if($chkData == 0 || $idGroup != '') {
            if($idGroup == '') {
                $guestCat = new GuestsCategory;
            } else {
                $guestCat = GuestsCategory::find($idGroup);
            }
            $guestCat->user_id = $userId;
            $guestCat->title = $request->group_name;
            $guestCat->save();
            if($guestCat->id) {
                echo 'inserted';
            }
        } else {
            echo 'error';
        }
    }

    public function remove_group($idx=null)
    {
        $userId = @\Auth::user()->id;
        $delt = GuestsCategory::where('id',$idx)->where('user_id',$userId)->delete();
        echo "deleted";
    }

    public function change_invitation_status($idx=null, $cStats=null)
    {
        $htmls = '';
        $getData = GuestsInvitationEvents::find($idx);
        $getData->attendances = $cStats;
        $getData->save();
        if($getData->id) {
            $htmls .= "<span class='app-input-label input-select-label input-filled' onclick='get_status(".$idx.");'>";
            if($cStats == 'confirmed') {
                $htmls .= "<i class='icon-tools icon-tools-checkbox mr10'></i>Confirmed";
            } elseif($cStats == 'pending') {
                $htmls .= "<i class='icon-tools icon-tools-clock-orange mr10'></i>Pending";
            } elseif($cStats == 'cancelled') {
                $htmls .= "<i class='icon-tools icon-tools-times-red mr10'></i>Cancelled";
            }
            $htmls .= "</span>";
            $htmls .= "<div class='app-input-dropdown input-select-dropdown hideStatusChange statusChange".$idx."''>";
            $htmls .= "<ul><li class='subtitle app-input-select-label '>";
            if($cStats == 'confirmed') {
                $htmls .= "<i class='icon-tools icon-tools-checkbox mr10'></i>Confirmed";
            } elseif($cStats == 'pending') {
                $htmls .= "<i class='icon-tools icon-tools-clock-orange mr10'></i>Pending";
            } elseif($cStats == 'cancelled') {
                $htmls .= "<i class='icon-tools icon-tools-times-red mr10'></i>Cancelled";
            }
            $htmls .= "</li><li ";
            if($cStats == 'pending'){
                $htmls .= "style='display:none;' >";
            } else {
                $htmls .= "onclick='change_invitation_status(".$idx.",0);' >";
            }
            $htmls .= "<i class='icon-tools icon-tools-clock-orange mr10'></i>Pending </li><li ";
            if($cStats == 'confirmed'){
                $htmls .= "style='display:none;' >";
            } else {
                $htmls .= "onclick='change_invitation_status(".$idx.",1);' >";
            }
            $htmls .= "<i class='icon-tools icon-tools-checkbox mr10'></i>Confirmed </li><li ";
            if($cStats == 'cancelled'){
                $htmls .= "style='display:none;' >";
            } else {
                $htmls .= "onclick='change_invitation_status(".$idx.",2);' >";
            }
            $htmls .= "<i class='icon-tools icon-tools-times-red mr10'></i>Cancelled </li></ul></div>";
            echo $htmls;
        }
    }

    public function change_invitation_menus($idx=null, $menus=null)
    {
        $htmls = '';
        $getData = GuestsInvitationEvents::find($idx);
        $getData->menus = $menus;
        $getData->save();
        if($getData->id) {
            $eventData = GuestsEvent::where('id',$getData->invited_for)->first();
            $eMenus = explode('--',$eventData->menu_types);
            $htmls .= "<span class='app-input-label input-select-label input-filled' onclick='get_menus(".$idx.");'>".$menus."</span>";
            $htmls .= "<div class='app-input-dropdown input-select-dropdown hideMenusChange menusChange".$idx."''>";
            $htmls .= "<ul><li class='subtitle app-input-select-label '>".$menus."</li>";
            for($em = 0; $em < count($eMenus); $em++) {
                if($menus == $eMenus[$em]){
                    $htmls .= "<li style='display:none;' >".$eMenus[$em]."</li>";
                } else {
                    $htmls .= '<li onclick="change_invitation_menus('.$idx.',\''.$eMenus[$em].'\');" >'.$eMenus[$em].'</li>';
                }
            }
            $htmls .= "<li class='guests-rows-select-add' onclick='get_newMenusModal(".$idx.");'><i class='icon-tools icon-tools-plus-circle-medium icon-left'></i>Create Menu </li></ul></div>";
            echo $htmls;
        }
    }

    public function add_menus(Request $request)
    {
        $chkDataNum = 0;
        $userId = \Auth::user()->id;
        $menu_name = $request->menu_name;
        $eventTblId = $request->eventTblId;
        $chkData = GuestsEvent::where('id',$eventTblId)->where('user_id',$userId)->first();
        $menuArr = explode('--',$chkData->menu_types);
        for($num = 0; $num < count($menuArr); $num++) {
            if(strtolower($menuArr[$num]) == strtolower($menu_name)) {
                $chkDataNum++;
            }
        }
        if($chkDataNum == 0 && $eventTblId != '') {
            $eventMenu = GuestsEvent::find($eventTblId);
            if($chkData->menu_types) {
                $eventMenu->menu_types = $chkData->menu_types.'--'.$menu_name;
            } else {
                $eventMenu->menu_types = $menu_name;
            }
            $eventMenu->save();
            if($eventMenu->id) {
                echo 'inserted';
            }
        } else {
            echo 'error';
        }
    }

    public function createNewMenu($idx=null, $menu_name=null)
    {
        $inviteData = GuestsInvitationEvents::where('id',$idx)->first();
        $preData = GuestsEvent::where('id',$inviteData->invited_for)->first();
        $saveData = GuestsEvent::find($inviteData->invited_for);
        if($preData->menu_types != '') {
            $saveData->menu_types = $preData->menu_types.'--'.$menu_name;
        } else {
            $saveData->menu_types = $menu_name;
        }
        $saveData->save();
        if($saveData->id) {
            echo 'done';
        }
    }

    public function updateMenu($idx=null, $menu_name=null, $old_menu_name=null)
    {
        $preData = GuestsEvent::where('id',$idx)->first();
        $saveData = GuestsEvent::find($idx);
        if($preData->menu_types != '') {
            $saveData->menu_types = str_replace($old_menu_name,$menu_name,$preData->menu_types);
        } else {
            $saveData->menu_types = $menu_name;
        }
        $saveData->save();
        if($saveData->id) {
            $inviteData = GuestsInvitationEvents::where('menus',$old_menu_name)->update(['menus' => $menu_name]);
            echo 'done';
        }
    }

    public function remove_menus($idx=null,$menus=null)
    {
        $userId = @\Auth::user()->id;
        $fetchData = GuestsEvent::where('id',$idx)->where('user_id',$userId)->first();
        $menuArr = explode('--',$fetchData->menu_types);
        $newMenus = '';
        for($nm = 0; $nm < count($menuArr); $nm++) {
            if($menuArr[$nm] != $menus) {
                if($newMenus == '') {
                    $newMenus = $menuArr[$nm];
                } else {
                    $newMenus .= '--'.$menuArr[$nm];
                }
            }
        }
        $eventUpdate = GuestsEvent::where('id',$idx)->update(['menu_types' => $newMenus]);
        $inviteDelete = GuestsInvitationEvents::where('menus',$menus)->delete();
        echo "deleted";
    }

    public function updateTable($chartId=null, $table_name=null)
    {
        $preData = SeatingChart::where('id',$chartId)->where('event_id',$idx)->first();
        $saveData = SeatingChart::find($chartId);
        $saveData->table_nm = $table_name;
        $saveData->save();
        if($saveData->id) {
            echo 'done';
        }
    }

    public function change_invitation_tables($invId=null,$chartId=null)
    {
        $userId =  \Auth::user()->id;
        $inviteData = GuestsInvitationEvents::where('id',$invId)->first();
        $guestData = GuestsListNew::where('id',$inviteData->guest_id)->first();
        $seatingData = SeatingChart::with(['seatdata'])->where('id',$chartId)->first();
        //// Delete previous guest record from seat arrangement....
        $previousGuest = SeatArrangement::where('gust_id',$inviteData->guest_id)->where('event_id',$inviteData->invited_for)->first();
        if($previousGuest->id) {
            $previousDlt = SeatArrangement::where('id',$previousGuest->id)->delete();
        }
        $seatId = $seatClass = '';
        for($snm = 0; $snm < $seatingData->table_seat; $snm++) {
            $seatId = 'table_'.$chartId.'_s'.$snm;
            $chkSeatId = SeatArrangement::where('seat_id',$seatId)->count();
            if($chkSeatId == 0) {
                break;
            }
        }
        $groomNum = $brideNum = 0;
        if($guestData->age_type == 'Adult' && $guestData->gender == 'Male') {
            if($guestData->group_id == 1 && $groomNum == 0) {
                $groomNum++;
                $seatClass = 'app-tables-guest-icon icon-tools-seating fright relative icon-tools-groom-small';
            } else {
                $seatClass = 'app-tables-guest-icon icon-tools-seating fright relative icon-tools-men-small';
            }
        } elseif($guestData->age_type == 'Child' && $guestData->gender == 'Male') {
            $seatClass = 'app-tables-guest-icon icon-tools-seating fright relative icon-tools-boy-small';
        } elseif($guestData->age_type == 'Adult' && $guestData->gender == 'Female') {
            if($guestData->group_id == 1 && $brideNum == 0) {
                $brideNum++;
                $seatClass = 'app-tables-guest-icon icon-tools-seating fright relative icon-tools-bride-small';
            } else {
                $seatClass = 'app-tables-guest-icon icon-tools-seating fright relative icon-tools-woman-small';
            }
        } elseif($guestData->age_type == 'Child' && $guestData->gender == 'Female') {
            $seatClass = 'app-tables-guest-icon icon-tools-seating fright relative icon-tools-girl-small';
        } elseif($guestData->age_type == 'Baby' && $guestData->gender != '') {
            $seatClass = 'app-tables-guest-icon icon-tools-seating fright relative icon-tools-child-small';
        } elseif($guestData->age_type == NULL && $guestData->gender == NULL) {
            $seatClass = 'app-tables-guest-icon icon-tools-seating fright relative icon-tools-adult-small';
        }
        $seatHtml = '<div class="app-tables-persona app-seated-guest" data-nombre="'.$guestData->firstname.' '.$guestData->lastname.'" data-idcontact="'.$guestData->id.'"><div class="tools-tables-gridItem-guest"><i class="'.$seatClass.'"></i></div><div class="app-tables-persona-name tools-tables-gridItem-guestName" title="'.$guestData->firstname.' '.$guestData->lastname.'"><span>'.$guestData->firstname.'</span><span>'.$guestData->lastname.'</span></div></div>';
        //// Add New guest record on seat arrangemant....
        $seatArrInsrt = new SeatArrangement;
        $seatArrInsrt->user_id        = $userId;
        $seatArrInsrt->gust_id        = $inviteData->guest_id;
        $seatArrInsrt->event_id       = $inviteData->invited_for;
        $seatArrInsrt->chart_list_id  = $seatingData->chart_list_id;
        $seatArrInsrt->chart_table_id = $chartId;
        $seatArrInsrt->seat_id        = $seatId;
        $seatArrInsrt->seat_gust_html = $seatHtml;
        $seatArrInsrt->save();
        if($seatArrInsrt->id) {
            ////// update initation table id as new id......
            $invtTableUpd = GuestsInvitationEvents::find($invId);
            $invtTableUpd->tables = $chartId;
            $invtTableUpd->save();
            //// Show this Html after change of table dropdown....
            $eventTables = SeatingChart::with(['seatdata'])->where('user_id',$userId)->where('event_id',$inviteData->invited_for)->where('table_type','!=','noSeats')->get();
            $htmls = '';
            $htmls .= "<span class='app-input-label input-select-label input-filled' onclick='get_tables(".$invId.");'>".$seatingData->table_nm." (".($seatingData->table_seat - count($seatingData->seatdata)-1).")</span>";
            $htmls .= "<div class='app-input-dropdown input-select-dropdown hideTablesChange tablesChange".$invId."''>";
            $htmls .= "<ul><li class='subtitle app-input-select-label '>".$seatingData->table_nm." (".($seatingData->table_seat - count($seatingData->seatdata)-1).")</li>";
            foreach($eventTables as $evt) {
                if(($evt->table_seat - count($evt->seatdata)) > 0) {
                    if($chartId == $evt->id) {
                        $htmls .= "<li style='display:none;' >".$evt->table_nm." (".($evt->table_seat - count($evt->seatdata)).")</li>";
                    } else {
                        $htmls .= '<li onclick="change_invitation_tables('.$invId.','.$evt->id.');" >'.$evt->table_nm.' ('.($evt->table_seat - count($evt->seatdata)).' )</li>';
                    }
                }
            }
            $seating_chart_url = 'window.location.href="'."seating_chart?idEvent=".$inviteData->invited_for.'"';
            $htmls .= "<li class='guests-rows-select-add' onclick='".$seating_chart_url."'><i class='icon-tools icon-tools-plus-circle-medium icon-left'></i>Add Table </li></ul></div>";
            echo $htmls;
        }
    }

    public function change_invitation_lists($idx=null, $lists=null)
    {
        $htmls = '';
        $getData = GuestsInvitationEvents::find($idx);
        $getData->lists = $lists;
        $getData->save();
        if($getData->id) {
            $eventData = GuestsEvent::where('id',$getData->invited_for)->first();
            $eLists = explode('--',$eventData->list_types);
            $htmls .= "<span class='app-input-label input-select-label input-filled' onclick='get_lists(".$idx.");'>".$lists."</span>";
            $htmls .= "<div class='app-input-dropdown input-select-dropdown hideListsChange listsChange".$idx."''>";
            $htmls .= "<ul><li class='subtitle app-input-select-label '>".$lists."</li>";
            for($em = 0; $em < count($eLists); $em++) {
                if($lists == $eLists[$em]){
                    $htmls .= "<li style='display:none;' >".$eLists[$em]."</li>";
                } else {
                    $htmls .= '<li onclick="change_invitation_lists('.$idx.',\''.$eLists[$em].'\');" >'.$eLists[$em].'</li>';
                }
            }
            $htmls .= "<li class='guests-rows-select-add' onclick='get_newListsModal(".$idx.");'><i class='icon-tools icon-tools-plus-circle-medium icon-left'></i>Add a List </li></ul></div>";
            echo $htmls;
        }
    }

    public function add_lists(Request $request)
    {
        $chkDataNum = 0;
        $userId = \Auth::user()->id;
        $list_name = $request->list_name;
        $eventTblIdList = $request->eventTblIdList;
        $chkData = GuestsEvent::where('id',$eventTblIdList)->where('user_id',$userId)->first();
        $listArr = explode('--',$chkData->list_types);
        for($num = 0; $num < count($listArr); $num++) {
            if(strtolower($listArr[$num]) == strtolower($list_name)) {
                $chkDataNum++;
            }
        }
        if($chkDataNum == 0 && $eventTblIdList != '') {
            $eventList = GuestsEvent::find($eventTblIdList);
            if($chkData->list_types) {
                $eventList->list_types = $chkData->list_types.'--'.$list_name;
            } else {
                $eventList->list_types = $list_name;
            }
            $eventList->save();
            if($eventList->id) {
                echo 'inserted';
            }
        } else {
            echo 'error';
        }
    }

    public function createNewList($idx=null, $list_name=null)
    {
        $inviteData = GuestsInvitationEvents::where('id',$idx)->first();
        $preData = GuestsEvent::where('id',$inviteData->invited_for)->first();
        $saveData = GuestsEvent::find($inviteData->invited_for);
        if($preData->list_types != '') {
            $saveData->list_types = $preData->list_types.'--'.$list_name;
        } else {
            $saveData->list_types = $list_name;
        }
        $saveData->save();
        if($saveData->id) {
            echo 'done';
        }
    }

    public function updateList($idx=null, $list_name=null, $old_list_name=null)
    {
        $preData = GuestsEvent::where('id',$idx)->first();
        $saveData = GuestsEvent::find($idx);
        if($preData->list_types != '') {
            $saveData->list_types = str_replace($old_list_name,$list_name,$preData->list_types);
        } else {
            $saveData->list_types = $list_name;
        }
        $saveData->save();
        if($saveData->id) {
            $inviteData = GuestsInvitationEvents::where('lists',$old_list_name)->update(['lists' => $list_name]);
            echo 'done';
        }
    }

    public function remove_lists($idx=null,$lists=null)
    {
        $userId = @\Auth::user()->id;
        $fetchData = GuestsEvent::where('id',$idx)->where('user_id',$userId)->first();
        $listArr = explode('--',$fetchData->list_types);
        $newLists = '';
        for($nm = 0; $nm < count($listArr); $nm++) {
            if($listArr[$nm] != $lists) {
                if($newLists == '') {
                    $newLists = $listArr[$nm];
                } else {
                    $newLists .= '--'.$listArr[$nm];
                }
            }
        }
        $eventUpdate = GuestsEvent::where('id',$idx)->update(['list_types' => $newLists]);
        $inviteDelete = GuestsInvitationEvents::where('lists',$lists)->delete();
        echo "deleted";
    }

    public function guest_eventForm(Request $request)
    {
        $userId = \Auth::user()->id;
        $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','41')->first();
        $data['guests_event'] = GuestsEvent::with(['guestsInvitationCount'])->where('user_id',$userId)->get();
        $idEvent = @$request->idEvent; //// Fetch event Data on change-event......
        $data['current_event'] = array();
        if($idEvent) {
            $data['current_event'] = GuestsEvent::with(['guestsInvitationCount'])->where('id',$idEvent)->first();
        }
        return view('tools.guest_eventForm',['data'=>$data]);
    }

    public function guest_add_event(Request $request)
    {
        $userId = \Auth::user()->id;
        $idEvent = $request->idEvent;
        $tabls = 'No';
        if(@$request->event_seating_chart == '1') {
            $tabls = 'Yes';
        }
        $menus = 'No';
        if(@$request->event_track_meals == '1') {
            $menus = 'Yes';
        }
        if($idEvent) {
            $gEvent = GuestsEvent::find($idEvent);
        } else {
            $gEvent = new GuestsEvent;
        }
        $gEvent->user_id = $userId;
        $gEvent->event_name = $request->event_name;
        $gEvent->tables = $tabls;
        $gEvent->menus = $menus;
        if($menus == 'Yes') {
            $gEvent->menu_types = $request->menuTypes;
        } else {
            $gEvent->menu_types = NULL;
        }
        $gEvent->lists = 'Yes';
        $gEvent->list_types = $request->listTypes;
        $gEvent->save();
        if($gEvent->id) {
            echo "inserted";
        }
    }

    public function guest_remove_event($idx=null)
    {
        $delt = GuestsEvent::where('id',$idx)->delete();
        if($idx) {
            echo "deleted";
        }
    }

    public function guest_stats(Request $request)
    {
        $idEvent = @$request->idEvent;
        if($idEvent) {
            $userId = \Auth::user()->id;
            $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','41')->first();
            $data['guestListData'] = GuestsInvitationEvents::leftJoin('guests_lists_new','guests_lists_new.id','=','guests_invitation_events.guest_id')
                                    ->select('guests_lists_new.*','guests_invitation_events.invited_for')->where('guests_invitation_events.invited_for',$idEvent)->groupBy('guests_invitation_events.guest_id')->get();
            $data['guestsCat'] = GuestsCategory::where('user_id',$userId)->where('status','1')->get();
            foreach($data['guestsCat'] as $nm => $vls) {
                $guestsCount = GuestsListNew::leftJoin('guests_invitation_events as GE','GE.guest_id','=','guests_lists_new.id')->where('invited_for',$idEvent)->where('group_id',$vls->id)->count();
                $data['guestsCat'][$nm]->groupCount = $guestsCount;
            }
            $data['guests_event'] = GuestsEvent::with(['guestsInvitationCount'])->where('user_id',$userId)->get();
            $data['current_event'] = GuestsEvent::with(['guestsInvitationCount'])->where('id',$idEvent)->first();
            $data['menu_types'] = array();
            $menu_types = explode('--',$data['current_event']->menu_types);
            for($menuNum = 0; $menuNum < count($menu_types); $menuNum++) {
                $menuInv = GuestsInvitationEvents::where('invited_for',$idEvent)->where('menus',$menu_types[$menuNum])->count();
                $data['menu_types'][$menu_types[$menuNum]] = $menuInv;
            }
            $data['seatingTable'] = SeatingChart::where('event_id',$idEvent)->where('status','1')->count();
            $data['seatingGuest'] = SeatArrangement::where('event_id',$idEvent)->where('gust_id','!=','')->count();
            // echo "<pre>"; print_r($data['menu_types']); die;
            return view('tools.guest_stats',['data'=>$data]);
        } else {
            return \Redirect::back();
        }
    }

    public function guest_onlineInvitation(Request $request)
    {
        $userId = \Auth::user()->id;
        $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','41')->first();
        $data['guestListData'] = GuestsListNew::with(['guestsInvitation'])->select('guests_lists_new.*','GC.id as cat_id','GC.title as cat_title')->leftJoin('guests_categories as GC','guests_lists_new.group_id','=','GC.id')->where('guests_lists_new.user_id',$userId)->orderBy('guests_lists_new.group_id','asc')->get();
        $data['guestsCat'] = GuestsCategory::with(['groupCount'])->where('user_id',$userId)->where('status','=','1')->get();
        // echo "<pre>"; print_r($data['guestsCat']); die;
        $data['guests_event'] = GuestsEvent::with(['guestsInvitationCount'])->where('user_id',$userId)->get();
        $idEvent = @$request->idEvent; //// Fetch event Data on change-event......
        $data['current_event'] = array();
        if($idEvent) {
            $data['current_event'] = GuestsEvent::with(['guestsInvitationCount'])->where('id',$idEvent)->first();
        }
        return view('tools.guest_onlineInvitation',['data'=>$data]);
    }

    public function guest_requestRSVP(Request $request)
    {
        $userId = \Auth::user()->id;
        $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','41')->first();
        $data['guestListData'] = GuestsListNew::with(['guestsInvitation'])->select('guests_lists_new.*','GC.id as cat_id','GC.title as cat_title')->leftJoin('guests_categories as GC','guests_lists_new.group_id','=','GC.id')->where('guests_lists_new.user_id',$userId)->orderBy('guests_lists_new.group_id','asc')->get();
        $data['guestsCat'] = GuestsCategory::with(['groupCount'])->where('user_id',$userId)->where('status','=','1')->get();
        // echo "<pre>"; print_r($data['guestsCat']); die;
        $data['guests_event'] = GuestsEvent::with(['guestsInvitationCount'])->where('user_id',$userId)->get();
        $idEvent = @$request->idEvent; //// Fetch event Data on change-event......
        $data['current_event'] = array();
        if($idEvent) {
            $data['current_event'] = GuestsEvent::with(['guestsInvitationCount'])->where('id',$idEvent)->first();
        }
        return view('tools.guest_requestRSVP',['data'=>$data]);
    }

    public function guest_requestAddress(Request $request)
    {
        $userId = \Auth::user()->id;
        $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','41')->first();
        $data['guestListData'] = GuestsListNew::with(['guestsInvitation'])->select('guests_lists_new.*','GC.id as cat_id','GC.title as cat_title')->leftJoin('guests_categories as GC','guests_lists_new.group_id','=','GC.id')->where('guests_lists_new.user_id',$userId)->orderBy('guests_lists_new.group_id','asc')->get();
        $data['guestsCat'] = GuestsCategory::with(['groupCount'])->where('user_id',$userId)->where('status','=','1')->get();
        // echo "<pre>"; print_r($data['guestsCat']); die;
        $data['guests_event'] = GuestsEvent::with(['guestsInvitationCount'])->where('user_id',$userId)->get();
        $idEvent = @$request->idEvent; //// Fetch event Data on change-event......
        $data['current_event'] = array();
        if($idEvent) {
            $data['current_event'] = GuestsEvent::with(['guestsInvitationCount'])->where('id',$idEvent)->first();
        }
        return view('tools.guest_requestAddress',['data'=>$data]);
    }





    // public function remove_guest($id){
    //     $userId =  \Auth::user()->id;
    //     if($id){
    //         GuestsList::destroy($id);
    //         return \Redirect()->back()->with('message','<span class="alert alert-success">Guest has been removed successfully.</span>');
    //     }else{ 
    //         return \Redirect::back()->with('message','<span class="alert alert-danger">Oops! Something went wrong please try again.</span>');
    //     }
    // }

    /*
    *  Create Guest List CSV
    * 
    */
    public function guest_export(){
        $currentDate = date('d_M_Y');
        \Excel::create('Guest_List_'.$currentDate, function($excel) {
        $excel->sheet('Excel sheet', function($sheet) {
        $userId =  \Auth::user()->id;
        $guestList = GuestsList::select('GC.title as Group','guests_lists.name as Name','guests_lists.attendance as Attendance','guests_lists.menu as Menu','guests_lists.age_type as Age',
          'guests_lists.gender as Gender','guests_lists.email as Email Id','guests_lists.phone as Phone','guests_lists.city as City'
          ,'guests_lists.address as Address','guests_lists.postal_code as Postal Code','guests_lists.country as Country')->leftJoin('guests_categories as GC','guests_lists.group_id','=','GC.id')->where('guests_lists.user_id',$userId)->orderBy('guests_lists.group_id','asc')->get()->toArray();
        $sheet->setOrientation('landscape');
        $sheet->fromArray($guestList);
            });
        })->export('xlsx');
    }

    /**
     * Save the Guest
     *
     * @return \Illuminate\Http\Response
     */
    public function save_guest_data(Request $request){
      
      $this->validate($request, [
                 'name' => 'required',
                 'group_id' => 'required',
                 'menu' => 'required',
                 'attendance' => 'required',
            ]);

      $userId =  \Auth::user()->id;
      $guestObj = new GuestsList;
      $guestObj->user_id = $userId;
      $guestObj->name = $request->input('name');
      $guestObj->attendance = $request->input('attendance');
      $guestObj->group_id = $request->input('group_id');
      $guestObj->menu = $request->input('menu');
      $guestObj->gender = ($request->input('gender')!=null)?$request->input('gender'):'male';
      $guestObj->age_type = ($request->input('age_type')!=null)?$request->input('age_type'):'adult'; 
      $guestObj->email = $request->input('mail');
      $guestObj->phone = $request->input('phone');
      $guestObj->city = $request->input('city');
      $guestObj->country = $request->input('country');
      $guestObj->address = $request->input('address');
      $guestObj->postal_code = $request->input('postal_code');
      $savD = $guestObj->save();
      if($savD){
          ///////////////////////////////////////////
          if($request->input('relatedData') !== null && !empty($request->input('relatedData'))){
              $relatedArr =  array();
              $conter = 0;
              foreach($request->input('relatedData') as $related){
                $agetyper = ($related['age_type'] != null)?$related['age_type']:'adult';
                $relatedArr[$conter]['user_id'] =  $userId;
                $relatedArr[$conter]['related_id'] =  $guestObj->id;
                $relatedArr[$conter]['attendance'] =  $request->input('attendance');
                $relatedArr[$conter]['group_id'] =  $request->input('group_id');
                $relatedArr[$conter]['gender'] =  ($related['gender'] != null)?$related['gender']:'male';
                $relatedArr[$conter]['menu'] =  ($related['age_type'] == 'baby')?'no menu assigned':$agetyper;
                $relatedArr[$conter]['age_type'] =  $agetyper;
                $relatedArr[$conter]['name'] =  trim($related['fname'].' '.$related['lname']);
                $conter++;
              }
             GuestsList::insert($relatedArr);
          }
          ///////////////////////////////////////////
          return response()->json([
                   'errorVal' => false,
                   'msg' => 'Action Successfully Done.'
          ],200);
       }else{
          return response()->json([
                   'errorVal' => true,
                   'msg' => 'Action Not Done.'
               ],422);
       }
    }

    // public function save_guest_data_new(Request $request) {
    
    //   $savD='';
    //   $count=count($request->input('firstname'));
    //   $related_id = 0;
    //   for ($i=0;$i<$count;$i++) {
    //     $invite = $request->input('invited_to');
    //     $inviteim = implode(',',$invite);
    //     $userId =  \Auth::user()->id;
    //     $guestObj = new GuestsList;
    //     $guestObj->user_id = $userId;
    //     $guestObj->related_id = $related_id;
    //     $guestObj->name = $request->input('firstname')[$i].' '.$request->input('lastname')[$i];
    //     $guestObj->address = $request->input('address');
    //     $guestObj->group_id = $request->input('group_id');
    //     $guestObj->attendance = $request->input('attendance');
    //     $guestObj->gender = ($request->input('gender')!=null)?$request->input('gender'):'male';
    //     $guestObj->age_type = ($request->input('age')[$i]!=null)?$request->input('age')[$i]:'adult'; 
    //     $guestObj->email = $request->input('email');
    //     $guestObj->phone = $request->input('phone');
    //     $guestObj->mobile = $request->input('mobile');
    //     $guestObj->city = $request->input('city');
    //     $guestObj->country = $request->input('country');
    //     $guestObj->menu = ($request->input('age')[$i]!=null)?$request->input('age')[$i]:'adult'; 
    //     $guestObj->postal_code = $request->input('postal_code');
    //     $guestObj->invited_to =$inviteim; 
    //     $guestObj->need_hotel = $request->input('need_hotel');
    //     $savD = $guestObj->save();
    //     if($i == 0) {
    //       $related_id = $guestObj->id;
    //     }
    //   }
    //   if($savD){

    //       return response()->json([
    //                'errorVal' => false,
    //                'msg' => 'Action Successfully Done.'
    //       ],200);
    //    }else{
    //       return response()->json([
    //                'errorVal' => true,
    //                'msg' => 'Action Not Done.'
    //            ],422);
    //    }
    // }

    public function getsingleguest(Request $request)
    {
        $guestid = $request->input('guestid');
        $data = GuestsListNew::Where('id',$guestid)->first();
        $inviteData = GuestsInvitationEvents::where('guest_id',$guestid)->get();
        $invFor = '';
        foreach($inviteData as $vals) {
            if($invFor == '') {
                $invFor = $vals->invited_for;
            } else {
                $invFor .= '--'.$vals->invited_for;
            }
        }
        $arr = array('id' => $data['id'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'age_type' => $data['age_type'],
            'gender' => $data['gender'],
            'group_id' => $data['group_id'],
            'need_hotel' => $data['need_hotel'],
            'invited_for' => $invFor,
            'email' => $data['email'],
            'phone_no' => $data['phone_no'],
            'mobile_no' => $data['mobile_no'],
            'address' => $data['address'],
            'city_town' => $data['city_town'],
            'postal_code' => $data['postal_code'],
        );
        echo json_encode($arr);
    }

    public function editguest_new(Request $request)
    {
        $userId = \Auth::user()->id;
        $edit_guestId = $request->edit_guestId;
        $needHotel = 'No';
        if(@$request->edit_need_hotel) {
            if($request->edit_need_hotel == 'on' || $request->edit_need_hotel == 'true') {
                $needHotel = 'Yes';
            }
        }
        $updGuests = GuestsListNew::find($edit_guestId);
        $updGuests->user_id     = $userId;
        $updGuests->firstname   = $request->edit_firstname;
        $updGuests->lastname    = $request->edit_lastname;
        $updGuests->age_type    = $request->edit_age_type;
        $updGuests->gender      = $request->edit_gender;
        $updGuests->group_id    = $request->edit_group_id;
        $updGuests->need_hotel  = $needHotel;
        $updGuests->email       = $request->edit_email;
        $updGuests->phone_no    = $request->edit_phone_no;
        $updGuests->mobile_no   = $request->edit_mobile_no;
        $updGuests->address     = $request->edit_address;
        $updGuests->city_town   = $request->edit_city_town;
        $updGuests->country     = $request->edit_country;
        $updGuests->postal_code = $request->edit_postal_code;
        $savD = $updGuests->save();
        if($savD) {
            $inviteData = GuestsInvitationEvents::where('guest_id',$edit_guestId)->delete();
            $invFor = '1';
            if($request->eventId) {
                $invFor = $request->eventId;
            }
            if(@$request->edit_invited_for) {
                foreach ($request->edit_invited_for as $in => $vls) {
                    if($request->edit_invited_for[$in] == 'on' || $request->edit_invited_for[$in] == 'true') {
                        $invFor = $in;
                    }
                    $newInvitation = new GuestsInvitationEvents;
                    $newInvitation->guest_id    = $edit_guestId;
                    $newInvitation->invited_for = $invFor;
                    $newInvitation->attendances = 'pending';
                    $newInvitation->save();
                }
            } else {
                $newInvitation = new GuestsInvitationEvents;
                $newInvitation->guest_id    = $edit_guestId;
                $newInvitation->invited_for = $invFor;
                $newInvitation->attendances = 'pending';
                $newInvitation->save();
            }
        }
        if($savD){
            return response()->json([
                'errorVal' => false,
                'msg' => 'Action Successfully Done.'
            ],200);
        } else {
            return response()->json([
                'errorVal' => true,
                'msg' => 'Action Not Done.'
            ],422);
        }
    }

   /**
     * Save the Guest
     *
     * @return \Illuminate\Http\Response
     */

    public function edit_guest_data(Request $request){
      $this->validate($request, [
                 'name' => 'required',
                 'group_id' => 'required',
                 'menu' => 'required',
                 'attendance' => 'required',
             ]);
      $userId =  \Auth::user()->id;
      $guestObj = GuestsList::find($request->input('guest_id'));
      $guestObj->user_id = $userId;
      $guestObj->name = $request->input('name');
      $guestObj->attendance = $request->input('attendance');
      $guestObj->group_id = $request->input('group_id');
      $guestObj->menu = $request->input('menu');
      $guestObj->gender = $request->input('gender');
      $guestObj->age_type = $request->input('age_type'); 
      $guestObj->email = $request->input('mail');
      $guestObj->phone = $request->input('phone');
      $guestObj->city = $request->input('city');
      $guestObj->country = $request->input('country');
      $guestObj->address = $request->input('address');
      $guestObj->postal_code = $request->input('postal_code');
      $savD = $guestObj->save();
      if($savD){
        return response()->json([
                   'errorVal' => false,
                   'msg' => 'Action Successfully Done.'
          ],200);
       }else{
          return response()->json([
                   'errorVal' => true,
                   'msg' => 'Action Not Done.'
               ],422);
       }
    }

    /**
     * Get the Guest data
     *
     */

    public function get_guest_data(Request $request){
      $guestId = $request->input('id');
      if($guestId){
           $dataVal = GuestsList::where('id','=',$guestId)->get()->toArray();
           return response()->json([
                   'errorVal' => false,
                   'data' => $dataVal,
                   'msg' => 'Action Successfully Done.'
          ],200);
      }else{
          return response()->json([
                   'errorVal' => true,
                   'msg' => 'Action Not Done.'
               ],422);
       }
    }

  /**
   * Show the Budget
   *
   * @return \Illuminate\Http\Response
   */

    public function budget(Request $request)
    {
        $userId =  \Auth::user()->id;
        $data['total_estimate'] = $data['total_final_cost'] = $data['total_paid'] = $data['total_pending'] = 0;
        $data['child_cats'] = TodoListCategory::where('status','=','1')->get()->toArray();
        $data['budgets'] = userBudget::where([['user_id','=',$userId]])->get()->toArray();
        $catBudget = userBudget::select('cat_id',DB::raw('sum(estimate_budget) as cat_budget'))->where('user_id',$userId)->groupBy('cat_id', 'user_id')->get()->toArray();
        if(isset($catBudget) && !empty($catBudget)){
            $data['catBudget'] = array_column($catBudget,'cat_budget','cat_id');
            $data['catBudget'] = array_map(function($num){return number_format($num);}, $data['catBudget']);
        }
        if(isset($data['budgets']) && !empty($data['budgets'])){
         $data['total_estimate'] = number_format(array_sum(array_column($data['budgets'],'estimate_budget')));
         $data['current_estimate'] = number_format(array_sum(array_column($data['budgets'],'estimate_budget')) - array_sum(array_column($data['budgets'],'paid')));
         $data['total_final_cost'] = number_format(array_sum(array_column($data['budgets'],'final_cost')));
         $data['total_paid'] = number_format(array_sum(array_column($data['budgets'],'paid')));
         $data['total_pending'] = number_format(array_sum(array_column($data['budgets'],'pending')));
        }
        $data['total_budget'] = \App\userTotalEstimateBudget::where('user_id',$userId)->first();
        $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','43')->first();
        /*echo"<pre>";
        print_r($data['total_budget']->toArray());
        die;*/
        return view('tools.budget',['data'=>$data]);
    }

  
   /**
   * Show the Budget
   *
   * @return \Illuminate\Http\Response
   */

    public function budget_category($cat_id)
    {
        $userId =  \Auth::user()->id;
        $data['total_estimate'] = 0;
        $data['total_final_cost'] = 0;
        $data['total_paid'] = 0;
        $data['cat_id'] = $cat_id;
        $data['child_cats'] = TodoListCategory::where('status','=','1')->get()->toArray();
        $data['currentCat'] = array_values(array_filter($data['child_cats'], function ($var) use ($cat_id) { return ($var['cat_id'] == $cat_id); }));
        $catBudget = userBudget::select('cat_id',DB::raw('sum(estimate_budget) as cat_budget'))->where('user_id',$userId)->groupBy('cat_id', 'user_id')->get()->toArray();
        if(isset($catBudget) && !empty($catBudget)){
            $data['catBudget'] = array_column($catBudget,'cat_budget','cat_id');
            $data['catBudget'] = array_map(function($num){return number_format($num);}, $data['catBudget']);
        } 
        $data['budgets'] = userBudget::where([['user_id','=',$userId],['cat_id','=',$cat_id]])->get()->toArray();
        if(isset($data['budgets']) && !empty($data['budgets'])){
         $data['total_estimate'] = number_format(array_sum(array_column($data['budgets'],'estimate_budget')));
         $data['total_final_cost'] = number_format(array_sum(array_column($data['budgets'],'final_cost')));
         $data['total_paid'] = number_format(array_sum(array_column($data['budgets'],'paid')));
        }
        //$this->debug($data['budgets']);
        $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','43')->first();
        return view('tools.budget_category',['data'=>$data]);
    }

  /**
   * Remove Budget
   *
   */

    public function remove_budget($id){
        if($id){
              userBudget::destroy($id);
              return \Redirect()->back()->with('message','<span class="alert alert-success">Budget list has been removed successfully.</span>');
        }else{ 
             return \Redirect::back()->with('message','<span class="alert alert-danger">Oops! Something went wrong please try again.</span>');
        }
    }

   /**
   * Save the Budget
   *
   */

    public function save_budget_data(Request $request){
      $this->validate($request, [
                 'concept' => 'required',
                 'cat_id' => 'required',
             ]);
      $userId =  \Auth::user()->id;
      $budgetObj = new userBudget;
      $budgetObj->user_id = $userId;
      $budgetObj->concept = $request->input('concept');
      $budgetObj->estimate_budget = str_replace(',','',$request->input('estimate_budget'));
      $budgetObj->final_cost = str_replace(',','',$request->input('final_cost'));
      $budgetObj->cat_id = $request->input('cat_id');
      if($request->input('task_id') !=''){
        $budgetObj->task_id = $request->input('task_id');
      }
      $budgetObj->paid = 0;
      $budgetObj->pending = 0;
      $savD = $budgetObj->save();
      if($savD){
        return response()->json([
                   'errorVal' => false,
                   'msg' => 'Action Successfully Done.'
          ],200);
       }else{
          return response()->json([
                   'errorVal' => true,
                   'msg' => 'Action Not Done.'
               ],422);
       }

    }

    /*
    *  Create Guest List CSV
    * 
    */

    public function budget_export(){
        $currentDate = date('d_M_Y');
        \Excel::create('Budget_List_'.$currentDate, function($excel) {
        $excel->sheet('Excel sheet', function($sheet) {
        $userId =  \Auth::user()->id;
        $guestList = userBudget::select('TLC.title as Category','user_budgets.concept as Concept','user_budgets.estimate_budget as Estimate Budget','user_budgets.final_cost as Final Cost','user_budgets.paid as Paid','user_budgets.pending as Pending')
        ->leftJoin('todo_list_categories as TLC','user_budgets.cat_id','=','TLC.cat_id')->where('user_budgets.user_id',$userId)->orderBy('TLC.id')->get()->toArray();
        $sheet->setOrientation('landscape');
        $sheet->fromArray($guestList);
            });
        })->export('xlsx');
    }


    /*
    *   Print budget report
    */

    public function get_BudgetReport() {

        $userId =  \Auth::user()->id;
        $data['user'] = \Auth::user();

        $data['userbudgetlist'] = TodoListCategory::with(['get_maincategory' => function($q) use ($userId) {
          $q->with(['get_user_budget' => function($u) use ($userId) {
            $u->where('user_id', $userId);
          }]);
        }])->where('status', '1')->get()->toArray();

        $data['usertotalestimateBudget'] = userTotalEstimateBudget::where('user_id', $userId);

        $data['budgets'] = userBudget::where([['user_id','=',$userId]])->get()->toArray();

        if(isset($data['budgets']) && !empty($data['budgets'])){
         $data['total_estimate'] = number_format(array_sum(array_column($data['budgets'],'estimate_budget')));
         $data['current_estimate'] = number_format(array_sum(array_column($data['budgets'],'estimate_budget')) - array_sum(array_column($data['budgets'],'paid')));
         $data['total_final_cost'] = number_format(array_sum(array_column($data['budgets'],'final_cost')));
         $data['total_paid'] = number_format(array_sum(array_column($data['budgets'],'paid')));
         $data['total_pending'] = number_format(array_sum(array_column($data['budgets'],'pending')));
        }

        // echo "<pre>";
        // print_r($todolist);
        // die();

        return view('tools.budgetreport',['data' => $data]);
    }

    /**
   * Edit the Budget
   *
   */

    public function edit_budget_data(Request $request){
      $this->validate($request, [
                 'id' => 'required',
             ]);
      $field = $request->input('field');
      $budgetObj = userBudget::find($request->input('id'));
      if($field == 'concept'){
        $budgetObj->concept = $request->input('value');
      }else{
       $budgetObj->$field = str_replace(',','',$request->input('value'));
      }
      $savD = $budgetObj->save();
      if($savD){
        return response()->json([
                   'errorVal' => false,
                   'msg' => 'Action Successfully Done.'
          ],200);
       }else{
          return response()->json([
                   'errorVal' => true,
                   'msg' => 'Action Not Done.'
               ],422);
       }

    }

    /**
   * Save Budget Payment
   *
   */

   public function add_budget_payment(Request $request){
      $paid = $request->input('paid');
      $id = $request->input('id');
      if(is_numeric($paid) && $id){
         $bObj = userBudget::find($id);
         if($request->input('is_paid') != null){
             $bObj->paid = $paid;
             $bObj->pending = 0;
         }else{
            $bObj->pending = $paid;
            $bObj->paid = 0;
         }
         $paidDate = null;
         if($request->input('paid_date') !== null){
            $myDateTime = \DateTime::createFromFormat('d/m/Y', $request->input('paid_date'));
            $paidDate = $myDateTime->format('Y-m-d');
         }
         $bObj->paid_date = $paidDate;
         $bObj->paid_by  = $request->input('paid_by');
         if($bObj->save()){
          return \Redirect()->back()->with('message','<span class="alert alert-success">Budget payment added successfully.</span>');
         }
      }
      return \Redirect::back()->with('message','<span class="alert alert-danger">Oops! Something went wrong please try again.</span>');
   }

   /**
   * Show the Budget
   *
   * @return \Illuminate\Http\Response
   */

    public function budget_payments()
    {
        $userId =  \Auth::user()->id;
        $data['budgetPayments'] = $guestList = userBudget::select('user_budgets.*','TLC.title as category')
        ->leftJoin('todo_list_categories as TLC','user_budgets.cat_id','=','TLC.cat_id')
        ->where('user_budgets.user_id','=',$userId)
        ->where(function($query){
            $query->where('user_budgets.paid','<>',0)->orWhere('user_budgets.pending','<>',0);
        })->get()->toArray();
        $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','43')->first();
        return view('tools.budget_payment',['data'=>$data]);
    }

    /**
     * User Mailbox
     *
     * @return \Illuminate\Http\Response
     */

    public function users_mailbox($type)
    {
        $data['titleData'] = \App\Page::where('id', 16)->first();
        $userId =  \Auth::user()->id;
        $data['userEnquery'] = ContactEnquiry::with(['replies', 'companyData' => function($q) {
          $q->with(['vendor_data' => function($qe) {
              $qe->with('image_data');
          }]);
        }])->where('user_id', $userId)->get();

        // echo "<pre>";
        // print_r($data['userEnquery']);

        // die();

         return view('tools.mailbox',['data'=>$data]);

         // die();

        // $userId =  \Auth::user()->id;
        // $mailType = $type ?? 'inbox';        
        // /*\App\ContactEnquiryReply::update_as_read($userId);*/ // Working Fine
        // $query = \App\ContactEnquiryReply::select('contact_enquiry_replies.*','VE.contact_person')
        // ->leftJoin('vendors as VE','contact_enquiry_replies.reply_by','=','VE.vendor_id')
        // ->where('contact_enquiry_replies.user_id','=',$userId);
        // if($mailType == 'administrator'){
        //   $query->where('contact_enquiry_replies.reply_by','=',0);
        // }
        // if($mailType == 'vendors'){
        //   $query->where('contact_enquiry_replies.reply_by','!=',0);
        // }
        // $query->where('contact_enquiry_replies.reply_by','!=',-1);
        // $query->orderBy('contact_enquiry_replies.id','desc');
        // $data['inbox'] = $query->get();                
        // $data['titleData'] = \App\Page::where('id', 16)->first();
        // return view('tools.mailbox',['data'=>$data,'mailType'=>$mailType]);
    }

    /**
     * User Mailbox
     *
     * @return \Illuminate\Http\Response
     */

    public function users_mailbox_details($id)
    {
        $data['titleData'] = \App\Page::where('id', 16)->first();
        $userId =  \Auth::user()->id;
        $data['userEnquery'] = ContactEnquiry::with(['user', 'companyData' => function($q) {
            $q->with(['vendor_data' => function($qe) {
                $qe->with('image_data');
            }]);
        }, 'replies' => function($Q) {
            $Q->orderBy('id','desc');
        }])->where('user_id', $userId)->where('id', $id)->get();

        $data['category'] = Category::where('id',$data['userEnquery'][0]['companyData']->vendor_data->cat_id)->first();
        $data['addVendor'] = UserAddedVendor::where('user_id',$userId)->where('vendor_id',$data['userEnquery'][0]['companyData']->vendor_data->vendor_id)->where('enquiry_id',$data['userEnquery'][0]->id)->first();
        // echo "<pre>";
        // print_r($data['addVendor']);
        // die();
        return view('tools.mailbox_details',['data'=>$data]);
        //  $userId = \Auth::user()->id;
        //  $emailId = \Auth::user()->email;
        //  $mailType = 'inbox';
        //  /*\App\ContactEnquiryReply::update_as_read($userId);*/ // Working Fine
        //  $query = \App\ContactEnquiryReply::select('contact_enquiry_replies.*','VE.contact_person','VE.email as vendor_email')
        //  ->leftJoin('vendors as VE','contact_enquiry_replies.reply_by','=','VE.vendor_id')
        //  ->where('contact_enquiry_replies.user_id','=',$userId);
        //  if($mailType == 'administrator'){
        //    $query->where('contact_enquiry_replies.reply_by','=',0);
        //  }
        //  if($mailType == 'vendors'){
        //    $query->where('contact_enquiry_replies.reply_by','!=',0);
        //  }
        //   $query->where('contact_enquiry_replies.id',$id);
        //  $data['message_details'] = $query->first();
        // /* echo"<pre>";
        //  print_r($data['message_details']->toArray());
        //  die;*/
        //  $data['titleData'] = \App\Page::where('id', 16)->first();
        //  return view('tools.mailbox_details',['data'=>$data,'mailType'=>$mailType,'email'=>$emailId]);
    }

    public function users_add_vendors(Request $request)
    {
        $addVndrDt = UserAddedVendor::where('user_id',$request->userId)->where('vendor_id',$request->vendorId)->where('enquiry_id',$request->enqId)->first();
        if(@$addVndrDt->id != '') {
            $addVendor = UserAddedVendor::find($addVndrDt->id);
        } else {
            $addVendor = new UserAddedVendor();
        }
        $addVendor->enquiry_id = $request->enqId;
        $addVendor->user_id    = $request->userId;
        $addVendor->vendor_id  = $request->vendorId;
        if($request->status == 'times') {
        	if($request->btnStatus == 'active') {
        		$addVendor->status = null;
        	} else {
        		$addVendor->status = '0';
        	}
            $addVendor->add_profile = 'No';
        } else
        if($request->status == 'check') {
        	if($request->btnStatus == 'active') {
        		$addVendor->status = null;
            	$addVendor->add_profile = 'No';
        	} else {
        		$addVendor->status = '1';
        	}
        }
        $addVendor->save();
        if($addVendor->id) {
            echo $addVendor->id;
        }
    }

    public function add_vendor_to_profile(Request $request)
    {
        if($request->addVendorId != '') {
            $addVendor = UserAddedVendor::find($request->addVendorId);
            $addVendor->add_profile = 'Yes';
            $addVendor->save();
            if($addVendor->id) {
                echo "done";
            }
        }
    }

    public function users_add_userRating(Request $request)
    {
        $addVndrDt = UserAddedVendor::where('user_id',$request->userId)->where('vendor_id',$request->vendorId)->where('enquiry_id',$request->enqId)->first();
        if(@$addVndrDt->id != '') {
            $addVendor = UserAddedVendor::find($addVndrDt->id);
        } else {
            $addVendor = new UserAddedVendor();
        }
        $addVendor->enquiry_id = $request->enqId;
        $addVendor->user_id    = $request->userId;
        $addVendor->vendor_id  = $request->vendorId;
        $addVendor->rating     = $request->userRating;
        $addVendor->save();
        if($addVendor->id) {
            echo $addVendor->rating;
        }
    }

    public function users_add_userPrice(Request $request)
    {
        $addVndrDt = UserAddedVendor::where('user_id',$request->userId)->where('vendor_id',$request->vendorId)->where('enquiry_id',$request->enqId)->first();
        if(@$addVndrDt->id != '') {
            $addVendor = UserAddedVendor::find($addVndrDt->id);
        } else {
            $addVendor = new UserAddedVendor();
        }
        $addVendor->enquiry_id = $request->enqId;
        $addVendor->user_id    = $request->userId;
        $addVendor->vendor_id  = $request->vendorId;
        $addVendor->price      = $request->prices;
        $addVendor->save();
        if($addVendor->id) {
            echo $addVendor->price;
        }
    }

    public function users_add_userNote(Request $request)
    {
        $addVndrDt = UserAddedVendor::where('user_id',$request->userId)->where('vendor_id',$request->vendorId)->where('enquiry_id',$request->enqId)->first();
        if(@$addVndrDt->id != '') {
            $addVendor = UserAddedVendor::find($addVndrDt->id);
        } else {
            $addVendor = new UserAddedVendor();
        }
        $addVendor->enquiry_id = $request->enqId;
        $addVendor->user_id    = $request->userId;
        $addVendor->vendor_id  = $request->vendorId;
        $addVendor->notes      = $request->notes;
        $addVendor->save();
        if($addVendor->id) {
            echo $addVendor->notes;
        }
    }

    /*
    *   Reply file Upload
    */
    public function replyFileupload(Request $request)
    {
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

    /*
    * Send message reply 
    *
    */
    protected function messageReplysend(Request $request)
    {
        // dd($request->all());
        $userId =  \Auth::user()->id;
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
            $reObj->reply_by = $userId;
            $reObj->message = $request->input('reply_message');
            $reObj->save();
        }
        $mailDataImage = array();
        $i = 0;
        if(isset($request->inputFiles)) {
            foreach ($request->inputFiles as $key => $inputFilesvalue)
            {
                $imageObj = EnquiryReplyimage::find($inputFilesvalue);
                $imageObj->enquiry_id = $request->input('enqury_id');
                $imageObj->enquiry_reply_id = $reObj->id;
                $imageObj->save();

                $mailDataImage[$i]['imagename'] = $imageObj->image_name;
                $mailDataImage[$i]['originalname'] = $imageObj->original_name;
                $i++;
            }
        }
        ///////////////////////////////////////
        $mailData['name'] = $request->input('enq_name');
        $mailData['email'] = $request->input('enq_email');
        $mailData['message'] = $request->input('reply_message');
        $mailData['fileData'] = $mailDataImage;

        // CC mail send
        $ccAddress = @$request->input('cc');
        try {
            if($ccAddress){
                Mail::to($request->input('enq_vendor_email'))->cc([$ccAddress])->send(new UserEnquiryReply($mailData));
            }else{
                Mail::to($request->input('enq_vendor_email'))->send(new UserEnquiryReply($mailData));
            }
            if(Mail::failures()) {
                return redirect()->back()->with('reply', '<div class="alert alert-danger">Something went wrong please try again.</div>');
            }else{
                $enObj = \App\ContactEnquiry::find($request->input('enqury_id'));
                $enObj->reply_status = 1;
                $enObj->save();
                return redirect()->back()->with('reply', '<div class="alert alert-success">Reply Message Sent Successfully.</div>');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('reply', '<div class="alert alert-danger">Something went wrong please try again.</div>');
        }
    }

    /**
     * Delete Mailbox
     *
     * @return \Illuminate\Http\Response
     */
    public function delete_mailbox(Request $request)
    {
        $userId =  \Auth::user()->id;
        $ids = $request->input('inbox_id');
        if(isset($ids) && !empty($ids)){
        \App\ContactEnquiryReply::where('user_id',$userId)->whereIn('id', $ids)->delete();
            return \Redirect()->back()->with('message','<span class="alert alert-success">Mail Deleted.</span>');
        }else{
            return \Redirect::back()->with('message','<span class="alert alert-danger">Oops! Something went wrong please try again.</span>');
        }
    }

    //  protected function mailbox_send(Request $request){
    //     $userId =  \Auth::user()->id;
    //     $this->validate($request, [
    //          'name' => 'required|string',
    //          'email' => 'required|email',
    //          'business_detail' => 'required',
    //      ],['name.required'=>'Name field is required.',
    //      'email.required'=>'Email address field is required.',
    //      'business_detail.required'=>'Message field is required.']);
    //       ///////////////////////////////////////
    //        $enquiry =  \App\ContactEnquiry::where('id', $request->input('enquiry_id'))->get()->toArray();
    //        if(isset($enquiry[0]) && !empty($enquiry[0])){
    //            $reObj = new \App\ContactEnquiry;
    //            $reObj->user_id = $userId;
    //            $reObj->name = $enquiry[0]['name'];
    //            $reObj->email = $enquiry[0]['email'];
    //            $reObj->phone = $enquiry[0]['phone'];
    //            $reObj->company_id = ($enquiry[0]['company_id'] != null)?$enquiry[0]['company_id']:0;
    //            $reObj->form_data = 2; 
    //            $reObj->reply_status = 0;
    //            $reObj->comment = $request->input('business_detail');
    //            $reObj->save();
    //        }
    //       ///////////////////////////////////////
    //       $mailData['name'] = $request->input('name');
    //       $mailData['email'] = $request->input('email');
    //       $mailData['message'] = $request->input('business_detail');
    //       $ccAddress = $request->input('cc');
    //       if($ccAddress){
    //          Mail::to($request->input('email'))->cc([$ccAddress])->send(new EnquiryReply($mailData));
    //       }else{
    //          Mail::to($request->input('email'))->send(new EnquiryReply($mailData));
    //        }
    //       if(Mail::failures()) {
    //          return redirect()->back()->with('message', '<div class="alert alert-danger">Something went wrong please try again.</div>');
    //       }else{
    //          return redirect()->back()->with('message', '<div class="alert alert-success">Reply Message Sent Successfully.</div>');
    //       }
    // }

   /**
   * Show the wedding website
   *
   * @return \Illuminate\Http\Response
   */

    public function wedding_website(Request $request)
    {
        $userId =  \Auth::user()->id;
        $weddingDetails = \App\weddingWebsite::where('user_id',$userId)->get()->toArray();
        if(isset($weddingDetails) && !empty($weddingDetails)){
            if($weddingDetails[0]['wedding_date']){
              $weddingDetails[0]['wedding_date'] = date('d/m/Y',strtotime($weddingDetails[0]['wedding_date']));
            }
            $data['parterData'] = $weddingDetails;
        }else{
          $partnerData = UserPartners::where('user_id',$userId)->get()->toArray();
          if(isset($partnerData[0]) && !empty($partnerData[0])){
            $data['parterData'][0]['couple_name'] = $partnerData[0]['name'].' & '.$partnerData[0]['partner_name'];
            $data['parterData'][0]['website_link'] = strtolower(str_replace(' ', '-', trim($partnerData[0]['name']))).'-and-'.strtolower(str_replace(' ', '-', trim($partnerData[0]['partner_name'])));
            if($partnerData[0]['wedding_date']){
              $data['parterData'][0]['wedding_date'] = date('d/m/Y',strtotime($partnerData[0]['wedding_date']));
            }
          }
        }

        $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','45')->first();
        return view('tools.website',['data'=>$data]);
    }

    /**
     * Save the wedding website
     *
     * @return \Illuminate\Http\Response
     */

    public function save_wedding_website(Request $request)
    {
        $userId =  \Auth::user()->id;
        $webId = $request->input('website_id');
        $this->validate($request, [
                 'couple_name' => 'required',
                 'wedding_date' => 'required',
                 'title' => 'required',
                 'description' => 'required',
                 'background_color' => 'required',
                 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                 'website_link' => 'required|alpha_dash|unique:wedding_websites,website_link,'.$webId,
        ]);
        $websiteObj = \App\weddingWebsite::firstOrNew(array('id' => $webId));
        $websiteObj->user_id = $userId;
        $websiteObj->couple_name = $request->input('couple_name');
        if($request->input('wedding_date')!=''){
          $fDate = str_replace('/', '-', $request->input('wedding_date'));
          $websiteObj->wedding_date = date('Y-m-d',strtotime($fDate));
        }
        $websiteObj->title = $request->input('title');
        $websiteObj->description = $request->input('description');
        $websiteObj->website_link = str_slug($request->input('website_link'),'-');
        $websiteObj->background_color = $request->input('background_color');
        if($request->file('image') !== null){
            $imageVl = $request->file('image');
            $file_name = 'WEB_'.time().'.'.$imageVl->getClientOriginalExtension();
            \Storage::put('/public/USER_'.$userId.'/'.$file_name,file_get_contents($imageVl)); 
            $websiteObj->banner_image = url('storage').'/USER_'.$userId.'/'.$file_name;
        }

        $isSave = $websiteObj->save();
        if($isSave){
        return \Redirect()->back()->with('message','<span class="alert alert-success">Wedding website updated successfully.</span>');
        }else{
          return \Redirect::back()->with('message','<span class="alert alert-danger">Oops! Something went wrong please try again.</span>');
        }
    }


    public function album_link_slug($title){
      $slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));
      $presentCount = \App\UserAlbum::select(DB::raw('count(*) as NumHits'))->where('album_link', 'like', '%' . $slug . '%')->first();
      $numHits = $presentCount['NumHits'];
      return ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;
    }

    /**
    * Show the wedshoots
    *
    * @return \Illuminate\Http\Response
    */

    public function wedshoots(Request $request)
    {
        $userId =  \Auth::user()->id;
        $countPhotos = 0;
        $weddingDetails = \App\UserAlbum::where('user_id',$userId)->get()->toArray();
        if(isset($weddingDetails) && !empty($weddingDetails)){
            $data['parterData'] = $weddingDetails;
            $countPhotos = \App\UserAlbumPhoto::where('album_id',$weddingDetails[0]['id'])->count();
        }else{
          $partnerData = UserPartners::where('user_id',$userId)->get()->toArray();
          if(isset($partnerData[0]) && !empty($partnerData[0])){  
            $data['parterData'][0]['couple_name'] = $partnerData[0]['name'].' & '.$partnerData[0]['partner_name'];
            $albumLink = strtolower(str_replace(' ', '-', trim($partnerData[0]['name']))).'-and-'.strtolower(str_replace(' ', '-', trim($partnerData[0]['partner_name'])));
            $data['parterData'][0]['album_link'] = $this->album_link_slug($albumLink);
          }else{
             $eventRole = \Auth::user()->event_role;
             $userName = \Auth::user()->name;
             if($eventRole == 'groom' || $eventRole == 'bride'){
                $roleHolder = array('groom'=>'Bride','bride'=>'Groom');
                $data['parterData'][0]['couple_name'] = $userName.' & '.$roleHolder[$eventRole];
                $albumLink = strtolower(str_replace(' ', '-', trim($userName))).'-and-'.strtolower(str_replace(' ', '-', trim($roleHolder[$eventRole])));
                $data['parterData'][0]['album_link'] = $this->album_link_slug($albumLink);
             }else{
                $data['parterData'][0]['couple_name'] = 'Groom & Bride';
                $data['parterData'][0]['album_link'] = $this->album_link_slug('groom-and-bride');
             }
          }
          $objAlbum = new \App\UserAlbum;
          $objAlbum->user_id = $userId;
          $objAlbum->album_link = $data['parterData'][0]['album_link'];
          $objAlbum->couple_name = $data['parterData'][0]['couple_name'];
          $objAlbum->save();
          $data['parterData'][0]['id'] = $objAlbum->id;
        }
        $data['parterData'][0]['total_pohots'] = $countPhotos;
        $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','47')->first();
        return view('tools.wedshoots',['data'=>$data]);
    }

   /**
    * Show the wedshoots
    *
    * @return \Illuminate\Http\Response
    */

    public function wedshoots_settings(Request $request)
    {
        $userId =  \Auth::user()->id;
        $photos = array();
        $weddingDetails = \App\UserAlbum::where('user_id',$userId)->get()->toArray();
        if(isset($weddingDetails) && !empty($weddingDetails)){
            $data['parterData'] = $weddingDetails;
            $photos = \App\UserAlbumPhoto::where('album_id',$weddingDetails[0]['id'])->get()->toArray();
        }else{
          $partnerData = UserPartners::where('user_id',$userId)->get()->toArray();
          if(isset($partnerData[0]) && !empty($partnerData[0])){
            $data['parterData'][0]['couple_name'] = $partnerData[0]['name'].' & '.$partnerData[0]['partner_name'];
            $data['parterData'][0]['album_link'] = strtolower(str_replace(' ', '-', trim($partnerData[0]['name']))).'-and-'.strtolower(str_replace(' ', '-', trim($partnerData[0]['partner_name'])));
          }
        }
        $data['photos'] = $photos;
        $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','47')->first();
        return view('tools.wedshoots_settings',['data'=>$data]);
    }

    /**
     * Save the wedding website
     *
     * @return \Illuminate\Http\Response
     */

    public function save_wedshoots_settings(Request $request)
    {
        $userId =  \Auth::user()->id;
        $webId = $request->input('id');
        $this->validate($request, [
                 'couple_name' => 'required',
                 'album_link' => 'required|alpha_dash|unique:user_albums,album_link,'.$webId,
        ]);
        $albumObj = \App\UserAlbum::firstOrNew(array('id' => $webId));
        $albumObj->user_id = $userId;
        $albumObj->couple_name = $request->input('couple_name');
        $albumObj->album_link = str_slug($request->input('album_link'),'-');
        $isSave = $albumObj->save();
        if($isSave){
        return \Redirect()->back()->with('message','<span class="alert alert-success">Album settings updated successfully.</span>');
        }else{
          return \Redirect::back()->with('message','<span class="alert alert-danger">Oops! Something went wrong please try again.</span>');
        }
    }

    /*
    * ---------------------------------------------------
    *  Upload Album Image Via Ajax
    * ---------------------------------------------------
    */


    public function upload_album_images(Request $request){
             $userId =  \Auth::user()->id;
             $this->validate($request, [
                  'userImageAlbum' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             ]);
             ////////////////////////////////////////
             $imageVl = $request->file('userImageAlbum');
             $file_name = 'ALBUM_'.time().'.'.$imageVl->getClientOriginalExtension();
             $stroreReturn = \Storage::put('/public/USER_'.$userId.'/'.$file_name,file_get_contents($imageVl)); 
             if($stroreReturn){
                 //************************************************//
                    $albumData = \App\UserAlbum::select('id')->where('user_id',$userId)->get()->toArray();
                    $albumImageObj = new \App\UserAlbumPhoto;
                    $albumImageObj->album_id = $albumData[0]['id'] ?? 0;
                    $albumImageObj->image = url('storage').'/USER_'.$userId.'/'.$file_name;
                    if($albumImageObj->save()){
                      $imagePath = url('storage').'/USER_'.$userId.'/'.$file_name;
                      return response()->json(array('errorVal'=>false,'id'=>$albumImageObj->id,'msg'=>$imagePath), 200);
                    }else{
                      return response()->json(array('errorVal'=>true,'id'=>0,'msg'=>'Image not saved. Please try again.'), 422);
                    }
                 //************************************************//
             }else{
                 return response()->json(array('errorVal'=>true,'id'=>0,'msg'=>'Image not uploaded. Please try again.'), 422);
             }        
    }

     /*
    * ---------------------------------------------------
    *  Delete Album Image Via Ajax
    * ---------------------------------------------------
    */

    public function delete_album_images(Request $request){
        $this->validate($request, [
                 'id' => 'required',
             ]);
        $flight = \App\UserAlbumPhoto::find($request->input('id'));
        if($flight->delete()){
           return response()->json(array('errorVal'=>false,'msg'=>'Image deleted successfully.'), 200);
        }else{
           return response()->json(array('errorVal'=>true,'msg'=>'Image not deleted. Please try again.'), 422);
         }    
    }


    public function save_album_image_note(Request $request){
        $this->validate($request, [
                 'id' => 'required',
                 'title' => 'required',
             ]);
        $flight = \App\UserAlbumPhoto::find($request->input('id'));
        $flight->title = $request->input('title');
        $flight->note = $request->input('note');
        if($flight->save()){
           return response()->json(array('errorVal'=>false,'msg'=>'Memory has been added successfully.'), 200);
        }else{
           return response()->json(array('errorVal'=>true,'msg'=>'Something went wrong. Please try again.'), 422);
         }    
    }

    /**
   * Save the total estimate Budget
   *
   */

    public function save_total_estimate_budget(Request $request){
      $this->validate($request, [
                 'estimate_budget' => 'required',
                 'user_id' => 'required',
             ]);
      $total_estimate = str_replace(',','',$request->input('estimate_budget'));
      $updateArr = array('total_estimate'=>$total_estimate);
      $savD = \App\userTotalEstimateBudget::where('user_id',$request->input('user_id'))->update($updateArr);
      if($savD){
        return response()->json([
                   'errorVal' => false,
                   'msg' => 'Action Successfully Done.'
          ],200);
       }else{
          return response()->json([
                   'errorVal' => true,
                   'msg' => 'Action Not Done.'
               ],422);
       }
    }


    /*
    *
    *   Share rating
    */

    public function shareRatings(Request $request) {
    //  dd($request->all());

      $vendorID = $request->input('app-suggest-vendor-input-id-add-vendor');
      $data['vendorData'] = Vendor::with('category_data', 'company_data')->where('vendors.vendor_id',$vendorID)->get()->toArray();
      
      $parenSulug = Category::where('id', $data['vendorData'][0]['category_data']['parent_id'])->get()->toArray();

      $parentCatslug = $parenSulug[0]['slug'];
      $chidCatslug = $data['vendorData'][0]['category_data']['slug'];
      $vendorSlug = $data['vendorData'][0]['company_data']['business_name_slug'];

      $vendorStoreUrl = url('/').'/'.$parentCatslug.'/'.$chidCatslug.'/'.$vendorSlug.'/?review=1';
      return redirect($vendorStoreUrl);
    }


}
