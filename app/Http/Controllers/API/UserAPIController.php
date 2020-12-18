<?php


namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\APIBaseController as APIBaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers; 
use Illuminate\Support\Str;
use Auth;
use App\User;
use App\UserPartners;

use App\Countries;
use View;
use Event;
use App\Events\UserCreated;
use App\TodoListCategory;
use App\TodoListDate;
use App\TodoList;
use App\TodoAnswerList;
use App\Category;
use App\VendorsForTask;
use App\UserBookedVendor;
use DB;
use App\GuestsList;
use App\userBudget;
use App\UserAlbumPhoto;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserChangePassword;
use App\Mail\UserVerifyLink;
use App\Mail\EnquiryReply;
use App\Mail\RequestEnquirySent;
use App\Mail\GuestUserVerifyLink;
use App\ContactEnquiry;
use App\VendorRating;

class UserAPIController extends APIBaseController {  
	
	use AuthenticatesUsers {
	    sendLoginResponse as protected _sendLoginResponse;
	}

    // get user login
		 
	protected function sendLoginResponse(Request $request) {
	    $this->_sendLoginResponse($request);
	    // Drop default redirect reponse	    
	    return $this->sendResponse(auth()->user(), 'Login successful.');    
	}
	 
	protected function sendFailedLoginResponse(Request $request) {
	    return $this->sendError( trans('auth.failed'), 'Login Failed', 422); 
	}

    // for creating access token for user login

	public function csrf($id) {

        if(User::where('id', $id)->exists()) {

            $tokenObj = User::where('id', $id)->first();
            if($tokenObj->api_token != NULL) {
                return response() ->json([ 'token' => $tokenObj->api_token ]);
            } else {
                $apiUserobj = User::find($id);
                $apiUserobj->api_token = Str::random(60);
                $apiUserobj->save();
                return response() ->json([ 'token' => $apiUserobj->api_token ]);
            }
        } else {
             return $this->sendError('Does not Exist', 'Something went wrong please try again.', $code = 422);
        }
    } 

    // refresh token 

    public function refreshcsrf($id) {

        if(User::where('id', $id)->exists()) {
            $apiUserobj = User::find($id);
            $apiUserobj->api_token = Str::random(60);
            $apiUserobj->save();
            return response() ->json([ 'token' => $apiUserobj->api_token ]);
        } else {
             return $this->sendError('Does not Exist', 'Something went wrong please try again.', $code = 422);
        }
    }   

    // get user signup 

	public function usersignup(Request $request) {		
    
        $eventDate = null;
        if(isset($request['event_date']) && !empty($request['event_date'])){
        $myDateTime = \DateTime::createFromFormat('d/m/Y', $request['event_date']);
        $eventDate = $myDateTime->format('Y-m-d');
        }
        $mailAllow = (isset($request['mail_allow']) && $request['mail_allow']!=NULL)?$request['mail_allow']:0;
        $userexit = User::where('email', '=', $request['email'])->first();
        if ($userexit !== null) {
           // user doesn't exist
            return $this->sendError('Exist', 'User is already exist', $code = 422);
        }
        
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'address' => $request['address'],
            'country' => $request['country'],
            'phone' => $request['phone'],
            'event_date' => $eventDate,
            'event_role' => $request['event_role'],
            'mail_allow' => $mailAllow,
            'password' => bcrypt($request['password']),
        ]);
        if($request['event_role'] != 'other'){
            UserPartners::create([
                'user_id' => $user->id,
                'name' => $request['name'],
                'wedding_date' => $eventDate,
                'gender' => $request['event_role'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        //////////////////////////////////////

        $listData = \App\TodoListCategory::where('status','=','1')->get()->toArray();
        if(isset($listData) && !empty($listData)) {
            $budgetArray = array();
            $counter = 0;
            foreach($listData as $cats){
                $initBudgets =  \App\initBudgets::where('cat_id',$cats['cat_id'])->where('status','=','1')->get()->toArray();
                if(!empty($initBudgets)){
                    foreach($initBudgets as $intb){                   
                    $budgetArray[$counter]['user_id'] = $user->id;
                    $budgetArray[$counter]['cat_id'] = $cats['cat_id'];
                    $budgetArray[$counter]['concept'] = $intb['title'];
                    $budgetArray[$counter]['estimate_budget'] = $intb['budget'];
                    $budgetArray[$counter]['final_cost'] = 0;
                    $budgetArray[$counter]['paid'] = 0;
                    $budgetArray[$counter]['pending'] = 0;
                    $budgetArray[$counter]['task_id'] = 0;
                    $budgetArray[$counter]['paid_date'] = '0000-00-00';
                    $counter++;
                    }
                }
            }
        }
        if(isset($budgetArray)) {
            \App\userBudget::insert($budgetArray);
            $totalBudgetArray['user_id'] = $user->id;
            $totalBudgetArray['total_estimate'] = array_sum(array_column($budgetArray,'estimate_budget'));
            $totalBudgetArray['created_at'] = date('Y-m-d H:i:s');
            $totalBudgetArray['updated_at'] = date('Y-m-d H:i:s');
            \App\userTotalEstimateBudget::insert($totalBudgetArray);

        }
        /////////////////////////////////////
        Event::fire(new UserCreated($user));
        return $user;
	}

    // get user data by userid

    public function userdata($id) {
        if(is_numeric($id)){
            $socialObj = User::with('user_albums','user_booked_vendor','user_budgets','user_partners','user_estimated_budget','user_verify_codes', 'user_photos','wedding_websites');  
            return $this->sendResponse($socialObj->where('id',$id)->get(), 'userdata fetch successfully');
        }     
    }

    // user profile picture 

    public function userprofilePicture(Request $request) {
        $name = "";
            if($request->hasFile('upload_image')) {
                $file = $request->file('upload_image');
                //you also need to keep file extension as well
                 if($request->hasFile('upload_image')) {
                    $userId = $request->id;
                    if($userId !=''){
                        $userObj = User::findOrFail($userId);
                        $userFolder = '/app/public/USER_'.$userId;
                        \Storage::makeDirectory($userFolder, 0755);
                        $file_data = $request->file('upload_image');                                        
                        $file_name = time().'_profile_img.'.$file_data->extension(); //generating unique file name;
                                   
                        if($file_data!=""){ // storing image in storage/app/public Folder                            
                            $file_data->move(storage_path($userFolder) , $file_name);   
                            $userObj->profile_image = $file_name;  
                            $userObj->save();
                            return $this->sendResponse('Changed successfully', 'Profile image changed successfully');
                        }else{
                            return $this->sendError($request->file('upload_image'), 'Images couldnt upload', $code = 400);
                        } 
                    }                 
                }else{
                    return $this->sendError('Does not Exist', 'User is not exist', $code = 400);
                }                
           }
        return $this->sendResponse($file->getClientOriginalName(), 'userdata fetch successfully'); 
    }

    // Save user wedding data
    public function save_my_wedding_data(Request $request){

        $file = $request->file('selfimage');
        $userId = $request->id;
        if(isset($userId) && $userId !=''){
            $weddingDate = null;
            if($request['wedding_date'] !== null && $request['wedding_date'] != ''){
              $myDateTimeVal = \DateTime::createFromFormat('d/m/Y', $request['wedding_date']);
              $weddingDate = $myDateTimeVal->format('Y-m-d');
            }
             $userObj = UserPartners::firstOrNew(array('user_id' => $userId));
             $userObj->name = $request['name'];
             $userObj->partner_name = $request['partner_name'];
             $userObj->gender = $request['gender'];
             $userObj->partner_gender = $request['partner_gender'];
             $userObj->venue = $request['venue'];
             $userObj->wedding_date = $weddingDate;
           


            $userFolder = '/app/public/USER_'.$userId;
                        \Storage::makeDirectory($userFolder, 0755);
            $file_data = $request->file('selfimage');                                       
            $file_name = time().'selfimage.'.$file_data->extension(); //generating unique file name;
            $file_data->move(storage_path($userFolder) , $file_name);   
            $userObj->avatar = $file_name;

           
            $file_datapartner = $request->file('partnerimage');                                       
            $file_namepartner = time().'partnerimage.'.$file_datapartner->extension(); //generating unique file name; 
            $file_datapartner->move(storage_path($userFolder) , $file_namepartner);   
            $userObj->partner_avatar = $file_namepartner;

             $data = $userObj->save();
             if($data){
                return $this->sendResponse($data, 'Profile has been updated successfully.');               
             }
        }
        return $this->sendError('Does not Exist', 'Something went wrong please try again.', $code = 422);

    }

    // get user current TO DO list and its data by userid 

        public function userto_do_list($userId) {

            if (User::where('id', '=', $userId)->exists()) {
               // user found
                    $data = array();
                    $data['todo_list_category'] = TodoListCategory::where('status','=','1')->get()->toArray();
                    $data['todo_list_date'] = TodoListDate::where('status','=','1')->get()->toArray();

                    $listedTasks = TodoList::select('id as list_id','title','description','todo_date_id','todo_cat_id','status as task_status')
                    ->where('user_id','=','0')->orWhere('user_id','=',$userId)        
                    ->get()->toArray();

                    $answerTasks = TodoAnswerList::select('list_id','title','description','todo_date_id','todo_cat_id','task_status')
                    ->where('user_id','=',$userId)      
                    ->get()->toArray();

                    $data['todo_list'] = $listedTasks;
                    $data['todo_answer'] = $answerTasks;

                    if($data){
                        return $this->sendResponse($data, 'To Do list get successfully');               
                    }
            } else {
                return $this->sendError('Does not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // get task details by user ID and task id 

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

        public function usertodolist_task_details(Request $request) {

            $userId = $request->user_id;
            $listId = $request->todolist_id;

            if (User::where('id', '=', $userId)->exists() && TodoList::where('id', '=', $listId)->exists() ) {

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
                 return $this->sendResponse($data, 'To Do list details get successfully');

            }else{
                
                return $this->sendError('Does not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // save user todo task using API

        public function usersave_todo_task(Request $request) {

            if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {
                $this->validate($request, [
                     'title' => 'required',
                     'description' => 'required',
                     'todo_cat_id' => 'required',
                     'todo_date_id' => 'required',
                ],['title.required'=>'Task title is required.',
                'description.required'=>'Task description is required.',
                'todo_cat_id.required'=>'Task category is required.',
                'todo_date_id.required'=>'Task start date is required.',
                ]);

                $todoObj = new TodoList;
                $todoObj->user_id = $request->user_id;
                $todoObj->title = $request->title;
                $todoObj->description = $request->description;
                $todoObj->todo_date_id = $request->todo_date_id;
                $todoObj->todo_cat_id = $request->todo_cat_id;
                $data = $todoObj->save();
                if($data){
                    return $this->sendResponse($data, 'Task has been created successfully.');
                }else{ 
                    return $this->sendError('Does not Save', 'Something went wrong please try again.', $code = 422);
                }
            }
            else {
                return $this->sendError('Does not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // add todo task to vendor from task details page

        public function useradd_vendor_to_todo_task(Request $request) {

             if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {

                $this->validate($request, [
                     'vendor_search_data' => 'required',
                     'vendor_hired' => 'required',
                 ]);
                $userId =  $request->user_id;
                $bookObj = UserBookedVendor::firstOrNew(array('user_id' => $userId,'vendor_id'=>$request->vendor_search_data));
                $bookObj->user_id = $userId;
                $bookObj->vendor_id = $request->vendor_search_data;
                $bookObj->book_status = ($request->vendor_hired == 1)? 6 : 3;
                $data = $bookObj->save();

                $listObj = VendorsForTask::firstOrNew(array('user_id' => $userId,'vendor_id'=>$request->vendor_search_data));
                $listObj->user_id = $userId;
                $listObj->vendor_id = $request->vendor_search_data;
                $listObj->list_id = $request->list_id;
                $data = $listObj->save();
                if($data){
                    return $this->sendResponse($data, 'Vendor added successfully to user To Do task');
                }else{ 
                    return $this->sendError('Does not Save', 'Something went wrong please try again.', $code = 422);
                }

            }
            else {
                return $this->sendError('Does not Exist', 'Something went wrong please try again.', $code = 422);
            }

        }

    // Get save and booked vender for user id

         public function useradd_user_vendors_category(Request $request)
        {
          //  dd($request->all());

            if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {

                $data['cat_id'] = $catId = $request->id_categ;
                $data['status'] = $status = $request->status;
                $data['status_counter'] = array();
                $userId =  $request->user_id;
                $query = DB::table('user_booked_vendors as UBV')->select('UBV.*','VN.vendor_id','VN.telephone as v_telephone','VN.email as v_email','CT.id as cat_id',
                    'CT.title as cat_name','CT.slug as cat_slug','CT1.title as cat_parent_name','CT1.slug as cat_parent_slug',
                    'VC.id as business_id','VC.business_name','VC.business_name_slug','VC.city')
                ->leftJoin('vendors as VN','UBV.vendor_id','=','VN.vendor_id')
                ->leftJoin('vendor_companies as VC','VN.vendor_id','=','VC.vendor_id')
                ->leftJoin('categories as CT','VN.cat_id','=','CT.id')
                ->leftJoin('categories as CT1','CT.parent_id','=','CT1.id')
                ->where('UBV.user_id','=',$userId);
                if(isset($catId) && $catId !='' && $catId != null){
                    $getCatParent = Category::select(DB::raw('GROUP_CONCAT(id) as ids'))->where([['is_parent','=',"0"],['parent_id','=',$catId]])->get()->toArray();
                    if(isset($getCatParent[0]['ids']) && $getCatParent[0]['ids'] !=''){
                       $catIdArray = explode(',',$getCatParent[0]['ids']);
                       $query->whereIn('CT.id',$catIdArray);
                    }else{
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

                if($data) {
                    return $this->sendResponse($data, 'saved Vendor data fetch successfully.');
                }else {
                    return $this->sendError('Does not get save', 'Something went wrong please try again.', $code = 422);
                }
            } else {
                return $this->sendError('Does not Exist check API token also', 'Something went wrong please try again.', $code = 422);
            }
        }

        public function getAllBookedVendorSideBar($userId) {
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

    // Update save vendor data for saved vendor.

        public function userudpate_saved_vendor_data(Request $request) {

            if($request->user_booked_vendors_id){
                $field = $request->fields;
                $data = $request->data_message;
                $objBooked = UserBookedVendor::find($request->user_booked_vendors_id);
                $objBooked->$field = $data;
                $objBooked->save();
                return $this->sendResponse($objBooked->id, 'saved Vendor data note updated successfully.');
             }else{
                return $this->sendError('Action Not Done', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Remove Booked vendor 

        public function userremove_booked_vendor(Request $request) {
                
           // dd($request->all());

            if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {

                if($request->user_booked_vendors_id){
                    UserBookedVendor::destroy($request->user_booked_vendors_id);
                    return $this->sendResponse(true, 'removed successfully.');
                }else{ 
                    return $this->sendError('Not Exist', 'Something went wrong please try again.', $code = 422);
                }
            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // get user Guests list by user id

        public function userget_guests($id) {

            if (User::where('id', '=', $id)->exists()) {

                $currentUser = User::select( array('name','event_role'))->where('id', '=', $id)->get();
                $userId =  $id;

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
                     $gender = $currentUser[0]->event_role;
                     if($gender == null || $gender =='' || $gender == 'groom'){ $gender1= 'male'; $gender2='female';}
                     else{ $gender1= 'female'; $gender2='male';}
                     $guestList[0]['user_id'] = $userId;
                     $guestList[0]['name'] = $currentUser[0]->name;
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
                $data['guestListData'] = GuestsList::select('guests_lists.*','GC.title as cat_title')->leftJoin('guests_categories as GC','guests_lists.group_id','=','GC.id')->where('guests_lists.user_id',$userId)->orderBy('guests_lists.group_id','asc')->get()->toArray();
                if(isset($data['guestListData']) && !empty($data['guestListData'])){
                   $data['total_guest'] = count($data['guestListData']);
                   $data['attendace'] = array_count_values(array_column($data['guestListData'],'attendance'));
                   $data['ages'] = array_count_values(array_column($data['guestListData'],'age_type'));
                   $data['menu'] = array_count_values(array_column($data['guestListData'],'menu'));
                   $data['groups'] = array_count_values(array_column($data['guestListData'],'group_id'));
                }
                $data['tab'] = 'All Tab Data';
                $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','41')->first();
                $data['guestsCat'] = \App\GuestsCategory::where('status','=','1')->get()->toArray();
                // $data['countries'] = \App\Countries::where('status','=',1)->get()->toArray();
                
                if($data) {
                    return $this->sendResponse($data, 'User guest list Geted successfully.');
                }else {
                    return $this->sendError('Not Exist', 'Something went wrong please try again.', $code = 422);
                }
            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Add gust to user

        public function usersave_guest_data(Request $request) {

            if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {
                $this->validate($request, [
                         'name' => 'required',
                         'group_id' => 'required',
                         'menu' => 'required',
                         'attendance' => 'required',
                    ]);

                $userId =  $request->user_id;
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

                if($savD) {

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
                  return $this->sendResponse('Insert Done', 'User guest added successfully.');
                } else{

                  return $this->sendError('Action Not Done.', 'Something went wrong please try again.', $code = 422);

                }
            }
            else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Get user Guest data by Guest ID

        Public function userget_guest_data_by_group($guestID) {
            $guestId = $guestID;

            if (GuestsList::where('id', '=', $guestId)->exists()) {
                $dataVal = GuestsList::where('id','=',$guestId)->get()->toArray();
               return $this->sendResponse($dataVal, 'Action Successfully Done.');
            }else{
              return $this->sendError('Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Edit data of Gusts for user

        public function useredit_guest_data(Request $request) {
            
            //dd($request->all());
            if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {
                $this->validate($request, [
                     'name' => 'required',
                     'group_id' => 'required',
                     'menu' => 'required',
                     'attendance' => 'required',
                ]);
                $userId =  $request->user_id;
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
                    return $this->sendResponse($savD, 'Action Successfully Done.');
                }else{
                    return $this->sendError('Action Not Done.', 'Something went wrong please try again.', $code = 422);
                }
            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Remove guest by guest and user id

        public function userremove_guest($userid, $guestid) {

            if (User::where('id', '=', $userid)->exists()) {
                if($guestid){
                      GuestsList::destroy($guestid);
                      return $this->sendResponse(true, 'Action Successfully Done.');
                }else{ 
                     return $this->sendError('Action Not Done.', 'Something went wrong please try again.', $code = 422);
                }
            }else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Show budget of user

        public function usershow_budget($userid) {

            if (User::where('id', '=', $userid)->exists()) {

                $userId =  $userid;
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
               // $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','43')->first();

                return $this->sendResponse($data, 'Action Successfully Done.');
            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Show payment budget for user

        public function userbudget_payments($userid) {

            if (User::where('id', '=', $userid)->exists()) {
                $userId =  $userid;
                $data['budgetPayments'] = $guestList = userBudget::select('user_budgets.*','TLC.title as category')
                ->leftJoin('todo_list_categories as TLC','user_budgets.cat_id','=','TLC.cat_id')
                ->where('user_budgets.user_id','=',$userId)
                ->where(function($query){
                      $query->where('user_budgets.paid','<>',0)->orWhere('user_budgets.pending','<>',0);
                 })
                ->get()->toArray();
               // $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','43')->first();

                return $this->sendResponse($data, 'Action Successfully Done.');
            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Get user Budget by category id 

        public function userbudget_category($userid, $catid) {

            if (User::where('id', '=', $userid)->exists()) {
                $userId =  $userid;
                $cat_id = $catid;
                $data['total_estimate'] = 0;
                $data['total_final_cost'] = 0;
                $data['total_paid'] = 0;
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
               // $data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','43')->first();
                return $this->sendResponse($data, 'Action Successfully Done.');
            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Save total estimate_budget for user

        public function usersave_total_estimate_budget(Request $request) {
            //dd($request->all());

            if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {
                $this->validate($request, [
                         'estimate_budget' => 'required',
                         'user_id' => 'required',
                     ]);
                $total_estimate = str_replace(',','',$request->input('estimate_budget'));
              //  $updateArr = array('total_estimate'=>$total_estimate);
                $budgetRow = \App\userTotalEstimateBudget::where('user_id',$request->user_id)->first();

                $budgetObj = \App\userTotalEstimateBudget::find($budgetRow->id);
                $budgetObj->total_estimate = $total_estimate;
                $budgetObj->save();

                if($budgetObj){
                    return $this->sendResponse($budgetObj, 'Action Successfully Done.');
                }else{
                    return $this->sendError('Action Not Done', 'Something went wrong please try again.', $code = 422);
                }
            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // save budget data for user and task also ( common for task budget and cat budget for saving data )

        public function usersave_budget_data(Request $request) {
           // dd($request->all());
            if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {
                $this->validate($request, [
                 'concept' => 'required',
                 'cat_id' => 'required',
                ]);
                $userId =  $request->user_id;
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
                return $this->sendResponse($savD, 'Action Successfully Done.');
                }else{
                   return $this->sendError('Action Not Done', 'Something went wrong please try again.', $code = 422);
                }
            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Edit budget for user

        public function useredit_budget_data(Request $request) {
            
            //dd($request->all());

            if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {

                $this->validate($request, [
                     'budget_id' => 'required',
                ]);

                $budgetObj = userBudget::find($request->input('budget_id'));

                if($request->input('concept')) {
                    $budgetObj->concept = $request->input('concept');
                }

                if($request->input('estimate_budget')) {
                    $budgetObj->estimate_budget = str_replace(',','',$request->input('estimate_budget'));
                }
                
                if($request->input('final_cost')) {
                    $budgetObj->final_cost = str_replace(',','',$request->input('final_cost'));
                }

                $savD = $budgetObj->save();

                if($savD){
                    return $this->sendResponse($savD, 'Action Successfully Done.');
                }else{
                   return $this->sendError('Action Not Done', 'Something went wrong please try again.', $code = 422);
                }
            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }

        }

    // Add budget payment by user ( Paid  )

        public function useradd_budget_payment(Request $request) {
            
            //dd($request->all());

            if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {
                $paid = $request->input('paid_amount');
                $id = $request->input('budget_id');

                $bObj = userBudget::find($id);
                if($request->input('is_paid') == 'yes'){
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
                $savD = $bObj->save();

                if($savD){
                  return $this->sendResponse($savD, 'Action Successfully Done.');
                }
            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Remove budget by user using budget id

        public function userremove_budget($budget_id) {
            if (userBudget::where('id', '=', $budget_id)->exists()) {
                userBudget::destroy($budget_id);
                return $this->sendResponse(true, 'Action Successfully Done.');
            }else{ 
                  return $this->sendError('budget id Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Get wedding website

        public function userwedding_website($userid) {

            if (User::where('id', '=', $userid)->exists()) {
                $userId =  $userid;
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
                //$data['titleData'] = Category::select('id','meta_title','meta_keyword','meta_description')->where('id','=','45')->first();
                return $this->sendResponse($data, 'Action Successfully Done.');
            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Save Wedding website data of User

        public function usersave_wedding_website(Request $request) {
            //dd($request->all());

            if (User::where('id', '=', $request->user_id)->exists()) {
                $userId =  $request->user_id;
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
                    return $this->sendResponse($isSave, 'Action Successfully Done.');
                }else{
                    return $this->sendError('False', 'Something went wrong please try again.', $code = 422);
                }

            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }   
        }

    // Get data for User wedshoots

        public function userwedshoots($userid) {

            if (User::where('id', '=', $userid)->exists()) {

                $currentUser = User::select( array('name','event_role'))->where('id', '=', $userid)->get();
                $userId =  $userid;
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
                     $eventRole = $currentUser->event_role;
                     $userName = $currentUser->name;
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
                return $this->sendResponse($data, 'Action Successfully Done.');
            } else {
                 return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Get webshoots setting data

        public function userwedshoots_settings($userid) {

            if (User::where('id', '=', $userid)->exists()) {
                $userId =  $userid;
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
                return $this->sendResponse($data, 'Action Successfully Done.');
            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Save User Webshoots Settings

        public function usersave_wedshoots_settings(Request $request) {
           // dd($request->all());
            if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {
                $userId =  $request->user_id;
                $webId = $request->input('album_id');
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
                     return $this->sendResponse($albumObj, 'Action Successfully Done.');
                }else{
                     return $this->sendError('Action is not done', 'Something went wrong please try again.', $code = 422);
                }
            } else {
                return $this->sendError('User Not Exist check token also.', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Upload images to album

        public function userupload_album_images(Request $request) {
            //dd($request->all());
           if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {
                $userId =  $request->user_id;
                $this->validate($request, [
                      'userImageAlbum' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $imageVl = $request->file('userImageAlbum');
                $file_name = 'ALBUM_'.time().'.'.$imageVl->getClientOriginalExtension();
                $stroreReturn = \Storage::put('/public/USER_'.$userId.'/'.$file_name,file_get_contents($imageVl)); 
                if($stroreReturn) {
                        $albumData = \App\UserAlbum::select('id')->where('user_id',$userId)->get()->toArray();
                        $albumImageObj = new \App\UserAlbumPhoto;
                        $albumImageObj->album_id = $albumData[0]['id'] ?? 0;
                        $albumImageObj->image = url('storage').'/USER_'.$userId.'/'.$file_name;
                        if($albumImageObj->save()){
                          $imagePath = url('storage').'/USER_'.$userId.'/'.$file_name;
                            return $this->sendResponse($imagePath, 'Action Successfully Done.');
                        }else{
                          return $this->sendError('Action is not done', 'Image not saved. Please try again.', $code = 422);
                        }
                }else{
                    return $this->sendError('Action is not done', 'Image not uploaded. Please try again.', $code = 422);
                }
            } else {
                return $this->sendError('User Not Exist check API token also', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Delete User Albums Images 

        public function userdelete_album_images($useralbumphoto_id) {

            if (UserAlbumPhoto::where('id', '=', $useralbumphoto_id)->exists()) {
                $flight = \App\UserAlbumPhoto::find($useralbumphoto_id);
                if($flight->delete()){
                    return $this->sendResponse(true, 'Image deleted successfully.');
                }else{
                   return $this->sendError('false', 'Image not deleted. Please try again.', $code = 422);
                }
            }else {
                return $this->sendError('Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Save Album image note 

        public function usersave_album_image_note(Request $request) {
            //dd($request->all());
            if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {
                $this->validate($request, [
                     'album_image_id' => 'required',
                     'title' => 'required',
                 ]);
                $flight = \App\UserAlbumPhoto::find($request->input('album_image_id'));
                $flight->title = $request->input('title');
                $flight->note = $request->input('note');
                if($flight->save()){
                   return $this->sendResponse(true, 'Memory has been added successfully.');
                }else{
                   return $this->sendError('false', 'Something went wrong please try again.', $code = 422);
                }
            } else {
                return $this->sendError('Not Exist', 'Something went wrong please try again.', $code = 422);
            }   
        }

          public function udpate_todo_list(Request $request){
                if($request->input('task_id')){
                    $field = $request->input('fields');
                    $data = $request->input('data');
                    $objTodo = TodoAnswerList::find($request->input('task_id'));
                    $objTodo->$field = $data;
                    $objTodo->save();
                    return $this->sendResponse($objTodo, 'Action Successfully Done.');
                 }else{
                    return response()->json([
                             'errorVal' => true,
                             'msg' => 'Action Not Done.'
                         ],422);
                 }
            }

    // Save task pending complete data by mark

        public function ajax_save_user_task(Request $request) {
            //dd($request->all());

            if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {
                $this->validate($request, [
                    'task_id' => 'required',
                    'task_oper' => 'required|string',
                    ],['task_id.required'=>'Oops! Task is not identify.',
                    'task_oper.required'=>'Oops! Task operation not found.',
                ]);
                $userId =  $request->user_id;
                // if pending (click on pending) then move to complete that's why pending set = 2 and complete also set 1
                $statusArray = array('pending'=>2,'complete'=>1,'delete'=>3);
                $list_id = $request->input('task_id');
                $getTaskDetails = TodoList::where('id','=',$list_id)->get()->toArray();
                $getAnsTask = TodoAnswerList::where(array('user_id' => $userId,'list_id'=>$list_id))->get()->toArray();
                if(isset($getAnsTask) && !empty($getAnsTask)){
                    $data =  TodoAnswerList::where('user_id', $userId)
                    ->where('list_id', $list_id)
                    ->update(['task_status' => $statusArray[$request->input('task_oper')]]);
                }else{
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
                if($data){
                    return $this->sendResponse($data, 'Action Successfully Done.');
                }else{
                     return $this->sendError('false', 'Something went wrong please try again.', $code = 422);
                }
            } else {
               return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422); 
            }
        }

    // Booked vendor by user in vendor section

        public function user_booked_vendor(Request $request) {

            if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {
                $this->validate($request, [
                     'vendor_search_data' => 'required',
                     'vendor_hired' => 'required',
                 ]);
                $userId =  $request->user_id;
                $bookObj = UserBookedVendor::firstOrNew(array('user_id' => $userId,'vendor_id'=>$request->input('vendor_search_data')));
                $bookObj->user_id = $userId;
                $bookObj->vendor_id = $request->input('vendor_search_data');
                $bookObj->book_status = ($request->input('vendor_hired') == 1)? 6 : 3;
                $data = $bookObj->save();
                if($data){
                    return $this->sendResponse($data, 'Action Successfully Done.');
                }else{ 
                    return $this->sendError(false, 'Something went wrong please try again.', $code = 422);
                }
            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Get profile picture 

        public function get_profile_img(){

            $userId =  \Auth::user()->id;
            $profileImage =  \Auth::user()->profile_image;
            if(isset($profileImage) && !empty($profileImage)){
                $proImagePath = url('storage/USER_'.$userId.'/'.$profileImage);
            }else{
                $proImagePath = url('storage/no-image.png');
            }
            return $proImagePath;
        }

    // Get user profile settings

        public function user_profile_settings($userid) {

            if (User::where('id', '=', $userid)->exists()) {
                $data['userData'] = User::select('*')->where('id', '=', $userid)->get();
                $data['profile_image'] = $this->get_profile_img();
                $countries = \App\Countries::where('status',1)->get()->toArray();
                $data['titleData'] = \App\Page::where('id', 14)->first();
                if($data) {
                    return $this->sendResponse($data, 'Action Successfully Done.');
                }else {
                    return $this->sendError('false', 'Something went wrong please try again.', $code = 422);
                }
            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Save user profile settings

        public function save_user_profile_settings(Request $request) {
            
           if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {
                     $this->validate($request, [
                         'name' => 'required|string|max:255',
                        'address' => 'required',
                        'country' => 'required',
                     ]);
                    $userId =  $request->user_id;
                    $userObj = User::find($userId);
                    $userObj->name = $request->input('name');
                    $userObj->address = $request->input('address');
                    $userObj->country = $request->input('country');
                    $userObj->phone = $request->input('phone');
                    $response = $userObj->save();
                    if($response) {
                        return $this->sendResponse($response, 'Profile Updated Successfully.');
                    }else{
                        return $this->sendError(false, 'Something went wrong please try again.', $code = 422);
                    }
            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Save Account setting change Password page

        public function save_account_password_settings(Request $request) {
            //dd($request->all());

            if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {
                $this->validate($request, [
                      'current_password' => 'required',
                      'password' => 'required|min:6|same:password',
                      'password_confirmation' => 'required|min:6|same:password',
                ]);
                $currentUser = User::select( array('name','email', 'password'))->where('id', '=', $request->user_id)->get();
                $current_password = $currentUser[0]->password;           
                if(\Hash::check($request->input('current_password'), $current_password))
                {           
                    $userId =  $request->user_id;
                    $emailAddress =  $currentUser[0]->email;
                    $sendData['name'] =  $currentUser[0]->name;
                    $userObj = User::find($userId);
                    $userObj->password = bcrypt($request->input('password'));
                    $response = $userObj->save();
                    if($response){
                       Mail::to($emailAddress)->send(new UserChangePassword($sendData));
                       return $this->sendResponse($response, 'Password Updated Successfully.');
                    }else{
                       return $this->sendError('false', 'Something went wrong! Please try again.', $code = 422);
                    }
                }
                else {           
                   return $this->sendError('false', 'Please enter correct current password.', $code = 422);
                }
            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }

        }

    // get user mail box message

        public function get_users_mailbox($userid, $type) {

             if (User::where('id', '=', $userid)->exists()) {
                $userId =  $userid;
                $mailType = $type ?? 'inbox';        
                /*\App\ContactEnquiryReply::update_as_read($userId);*/ // Working Fine
                $query = \App\ContactEnquiryReply::select('contact_enquiry_replies.*','VE.contact_person')
                ->leftJoin('vendors as VE','contact_enquiry_replies.reply_by','=','VE.vendor_id')
                ->where('contact_enquiry_replies.user_id','=',$userId);
                if($mailType == 'administrator'){
                  $query->where('contact_enquiry_replies.reply_by','=',0);
                }
                if($mailType == 'vendors'){
                  $query->where('contact_enquiry_replies.reply_by','!=',0);
                }
                $query->where('contact_enquiry_replies.reply_by','!=',-1);
                $query->orderBy('contact_enquiry_replies.id','desc');

                $data['inbox'] = $query->get();                
                $data['mailType'] = $mailType;

                if(count($data['inbox']) > 0) {
                    return $this->sendResponse($data, 'Data Get Successfully.');
                }else {
                    return $this->sendResponse(false, 'Data not found');
                }

            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Get mailbox message details

        public function get_users_mailbox_details($userid, $mailboxid) {

            if (User::where('id', '=', $userid)->exists()) {
                $userId = $userid;
                $currentUser = User::select( array('email'))->where('id', '=', $userid)->get();
                $emailId =  $currentUser[0]->email;
                $mailType = 'inbox';

                $query = \App\ContactEnquiryReply::select('contact_enquiry_replies.*','VE.contact_person','VE.email as vendor_email')
                ->leftJoin('vendors as VE','contact_enquiry_replies.reply_by','=','VE.vendor_id')
                ->where('contact_enquiry_replies.user_id','=',$userId);

                if($mailType == 'administrator'){
                  $query->where('contact_enquiry_replies.reply_by','=',0);
                }

                if($mailType == 'vendors'){
                  $query->where('contact_enquiry_replies.reply_by','!=',0);
                }

                $query->where('contact_enquiry_replies.id',$mailboxid);
                $data['message_details'] = $query->first();
                $data['mailType'] = $mailType;
                $data['email'] = $emailId;

                if(count($data['message_details']) > 0) {
                    return $this->sendResponse($data, 'mainbox details Get Successfully.');
                }else {
                    return $this->sendResponse(false, 'Data not found');
                }

            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Delete mail from mail box

        public function user_delete_mailbox(Request $request) {
            //dd($request->all());
           if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {
              $userId =  $request->user_id;
              $ids = $request->input('mailbox_id');

              if(isset($ids) && !empty($ids)){
                \App\ContactEnquiryReply::where('user_id',$userId)->whereIn('id', $ids)->delete();
                return $this->sendResponse(true, 'Mainbox deleted Successfully.');
              }else{
                return $this->sendError(false, 'Something went wrong please try again.', $code = 422);
              }
            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Sewnd mail by user

        public function user_mailbox_send(Request $request) {
            //dd($request->all());

            if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {
                $userId =  $request->user_id;

                $this->validate($request, [
                     'name' => 'required|string',
                     'email' => 'required|email',
                     'business_detail' => 'required',
                 ],['name.required'=>'Name field is required.',
                 'email.required'=>'Email address field is required.',
                 'business_detail.required'=>'Message field is required.']);

                   $enquiry =  \App\ContactEnquiry::where('id', $request->input('enquiry_id'))->get()->toArray();
                   if(isset($enquiry[0]) && !empty($enquiry[0])){
                       $reObj = new \App\ContactEnquiry;
                       $reObj->user_id = $userId;
                       $reObj->name = $enquiry[0]['name'];
                       $reObj->email = $enquiry[0]['email'];
                       $reObj->phone = $enquiry[0]['phone'];
                       $reObj->company_id = ($enquiry[0]['company_id'] != null)?$enquiry[0]['company_id']:0;
                       $reObj->form_data = 2; 
                       $reObj->reply_status = 0;
                       $reObj->comment = $request->input('business_detail');
                       $reObj->save();
                   }
                  ///////////////////////////////////////
                  $mailData['name'] = $request->input('name');
                  $mailData['email'] = $request->input('email');
                  $mailData['message'] = $request->input('business_detail');
                  $ccAddress = $request->input('cc');

                  if($ccAddress){
                     Mail::to($request->input('email'))->cc([$ccAddress])->send(new EnquiryReply($mailData));
                    }else{
                     Mail::to($request->input('email'))->send(new EnquiryReply($mailData));
                   }

                  if(Mail::failures()) {
                     return $this->sendError(false, 'Something went wrong please try again.', $code = 422);
                  }else{
                     return $this->sendResponse(true, 'Reply Message Sent Successfully.');
                  }
            } else {
                return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }
        }

    // Request enquiry to vendor by user ( Common for user and website )

        public function user_vendorRequestEnquiry(Request $request) {
          //  dd($request->all());
            $contactObj = new ContactEnquiry;
            $this->validate($request, [
                 'name' => 'required|string',
                 'email' => 'required|email',
                 'phone' => 'required',
             ],['name.required'=>'Name field is required.',
             'email.required'=>'Email address field is required.',
             'phone.required'=>'Phone number is required.']);
            $eventDate = null;
            if($request->input('event_date') !== null && $request->input('event_date') != ''){
            $myDateTime = \DateTime::createFromFormat('d/m/Y', $request->input('event_date'));
            $eventDate = $myDateTime->format('Y-m-d');
            }
            
            if($request->user_id != 0){
                $contactObj->user_id = $request->user_id;
            }else {
                if(User::where('email',  $request->input('email'))->exists()) {
                    $userobj = User::where('email',  $request->input('email'))->first();
                    $contactObj->user_id = $userobj->id;
                } else {
                    $user = User::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'event_date' => $eventDate,
                    'phone' => $request->input('phone'),
                    'password' => bcrypt('123@perfact'),
                    'guest' => 1,
                    ]);

                    $contactObj->user_id = $user->id;
                    $subject = 'Account Verify and Access';
                    $viewfile = 'guest_user_verify';
                    Mail::to($request->input('email'))->send(new GuestUserVerifyLink($user->toArray(),$subject,$viewfile));
                }
                
            }

            $contactObj->name = $request->input('name');
            $contactObj->email = $request->input('email');
            $contactObj->number_of_guests = $request->input('number_of_guests');
            $contactObj->event_date = $eventDate;
            $contactObj->phone = $request->input('phone');
            $contactObj->comment = $request->input('comment');
            $contactObj->company_id = $request->input('company_id');
            $contactObj->form_data = 2;
            $data = $contactObj->save();
            if($data){
                $compayData = DB::select('select V.vendor_id,V.telephone,V.email,V.message_notify_email,V.mobile,VC.business_name,VC.business_address,VC.province,VC.country from vendors AS V left join vendor_companies as VC ON V.vendor_id = VC.vendor_id where VC.id = :id', ['id' => $contactObj->company_id]);

                // Mail to user
                    $subject = "Your enquiry has been sent";
                    $viewm = 'request_enquiry_sent';
                    Mail::to($request->input('email'))->send(new RequestEnquirySent($contactObj->toArray(),$compayData,$subject,$viewm));

                // Mail to vendor
                    $vendorEmail = $compayData[0]->email;
                    if($compayData[0]->message_notify_email != '' && $compayData[0]->message_notify_email != NULL) {
                        $vendorEmail = $compayData[0]->message_notify_email;
                    }

                    if($vendorEmail != ''){
                        $subject = "New enquiry has been received";
                        $viewm ='admin_request_enquiry';
                        Mail::to($vendorEmail)->send(new RequestEnquirySent($contactObj->toArray(),$compayData,$subject,$viewm));
                    }

                return $this->sendResponse(true, 'Enquiry has been sent successfully.');
            }else{
                return $this->sendError(false, 'Something went wrong please try again.', $code = 422);
            }
        }

    // Save Review to vendor by current Login User

        public function website_save_review(Request $request) {
            //dd($request->all());

            if ( isset($request->_token) && $request->_token != NULL && User::where('id', '=', $request->user_id)->where('api_token', $request->_token)->exists()) {
                $contactObj = new VendorRating;
                $this->validate($request, [
                     'rname' => 'required|string',
                     'remail' => 'required|email',
                     'score' => 'required',
                 ],['name.required'=>'Name field is required.',
                 'email.required'=>'Email address field is required.',
                 'score.required'=>'Rating is required.']);
                $contactObj->vendor_id = $request->input('vendor_id');
                $contactObj->user_id = $request->input('vendor_id');
                $contactObj->name = $request->input('rname');
                $contactObj->email = $request->user_id;
                $contactObj->quality_of_service = 0;
                $contactObj->responsiveness = 0;
                $contactObj->professionalism = 0;
                $contactObj->value = 0;
                $contactObj->flexibility = 0;
                $contactObj->average_rating = $request->input('score');
                $contactObj->review_description = $request->input('review_description');
                $data = $contactObj->save();
                if($data){
                    return $this->sendResponse(true, 'Review has been sent successfully.');
                }else{
                    return $this->sendError('False', 'Something went wrong please try again.', $code = 422);
                }
            }else {
                 return $this->sendError('User Not Exist', 'Something went wrong please try again.', $code = 422);
            }

        }

}