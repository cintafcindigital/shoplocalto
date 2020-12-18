<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use Auth;
use Route;
use Session;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function index()
    {
        return view('admin/dashboard');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    
    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);
        // Attempt to log the user in
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $admins = Admin::where('email',$request->email)->first();
            Session::push('adminData',collect($admins));
            // if successful, then redirect to their intended location
            return redirect()->intended(route('admin.dashboard'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->with('msg','Invalid Credentials. Please try again.');
    }
    
    public function logout()
    {
        Session::put('adminData',[]);
        Auth::guard('admin')->logout();
        return redirect('/admin/login')->with('msg-success','You have successfully logged out!');
    }
}