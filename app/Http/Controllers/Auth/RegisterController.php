<?php
namespace App\Http\Controllers\Auth;
use App\User;
use App\UserPartners;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Page;
use App\States;
use App\Countries;
use App\Categories;
use View;
use Event;
use App\Events\UserCreated;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard/initPlanner';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $pageData = Page::select('id','url','title','image','image_description','description','meta_title','meta_description','meta_keyword')->where('id', 6)->first();
        $states = States::where('status',1)->get()->toArray();
        $countries = Countries::where('status',1)->get()->toArray();
        View::share(['pageData'=>$pageData,'states'=>$states,'countries'=>$countries]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // die('some');
        return Validator::make($data, [
            'name' => 'required|string|max:200',
            'email' => 'required|string|email|max:200|unique:users',
            'password' => 'required|string|min:6',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'category' => 'required'
            // 'country' => 'required',
            // 'event_role' => 'required',
        ],[ 'name.required'=>'First and Last Name field is required.',
            'email.required'=>'Email id field is required.',
            'password.required'=>'Password field is required.',
            'address.required'=>'Live in place field is required.',
            'city.required'=>'City field is required.',
            'province.required'=>'Province field is required.',
            'category.required' => 'Category is required.'
            // 'country.required'=>'Country field is required.',
            // 'event_role.required'=>'You must select your role in this event.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $eventDate = null;
        if(isset($data['event_date']) && !empty($data['event_date'])){
            $myDateTime = \DateTime::createFromFormat('d/m/Y', $data['event_date']);
            $eventDate = $myDateTime->format('Y-m-d');
        }
        $mailAllow = (isset($data['mail_allow']) && $data['mail_allow']!=NULL)?$data['mail_allow']:0;
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'city' => $data['city'],
            'province' => $data['province'],
            'country' => 'CA',
            'phone' => $data['phone'],
            'category_id' => $data['category'],
            // 'event_date' => $eventDate,
            // 'event_role' => $data['event_role'],
            'mail_allow' => $mailAllow,
            'password' => bcrypt($data['password']),
        ]);
        /*if($data['event_role'] != 'other'){
        }*/
        UserPartners::create([
            'user_id' => $user->id,
            // 'name' => $data['name'],
            'wedding_date' => date('Y-m-d H:i:s'),
            'gender' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //////////////////////////////////////
        $listData = \App\TodoListCategory::where('status','=','1')->get()->toArray();
        if(isset($listData) && !empty($listData)){
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
        if(isset($budgetArray)){
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
}
