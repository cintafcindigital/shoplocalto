<?php

namespace App\Http\Controllers\Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\Page;
use View;
use Socialite;
use session;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = '/dashboard';

    protected function authenticated(Request $request, $user)
    {
        // if($request->redirect_url == url('/').'/') {
            session(['bride_toDoList_popup' => 'allow']);
            return redirect('/dashboard');
        // }else {
        //     return redirect($request->redirect_url);
        // }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $pageData = Page::select('id','url','title','image','image_description','description','meta_title','meta_description','meta_keyword')->where('id', 7)->first();
        View::share('pageData', $pageData);
    }

    public function logout(Request $request) {
       Auth::logout();
      return redirect('/');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {

        $user = Socialite::driver('facebook')->user();
        $authUser = $this->findOrCreateUser($user);

        if(!$authUser) {
            return redirect('/login')->with('error', 'User Email is already Exist.');
        }else {
            return redirect(url('/guest-account-verify').'/'.base64_encode($authUser->id));
        }
       
    }

    public function findOrCreateUser($user)
    {

        $authUser = User::where('email', $user->getEmail())->first();
        if ($authUser) {
            //return $authUser;
             return false;   
        }
        return User::create([
            'name'     => $user->getName(),
            'email'    => $user->getEmail(),
            'provider' => 'Facebook',
            'provider_id' => $user->getId(),
            'password' => ''
        ]);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */

    public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

     /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */

    public function handleProviderGoogleCallback() {

        try {
            
            $user = Socialite::driver('google')->user();
            $authUser = $this->findOrCreateUserGoogle($user);

            if(!$authUser) {
                return redirect('/login')->with('error', 'User Email is already Exist.');
            }else {
                return redirect(url('/guest-account-verify').'/'.base64_encode($authUser->id));
            }

        } catch (\Exception $e) {
            return redirect('/login');
        }

    }


    public function findOrCreateUserGoogle($user)
    {

        $authUser = User::where('email', $user->email)->first();
        if ($authUser) {
            //return $authUser;
             return false;   
        }
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => 'Google',
            'provider_id' => $user->id,
            'password' => ''
        ]);
    }
}
