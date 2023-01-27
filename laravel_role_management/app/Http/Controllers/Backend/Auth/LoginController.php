<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::ADMIN_DASHBOARD;



    public function showLoginForm(Request $request){
        return view('backend.auth.login');
    }

    public function login(Request $request){
        
        //validate login data
        $request->validate([
            'email' => 'required|max:50',
            'password' => 'required',
        ]);

        // attempt to login
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            //redirect to dashboard
            session()->flash('success', 'Successfully Logged in !');
            return redirect()->intended(route('admin.dashboard'));
        }else{
            // Search using username
            if(Auth::guard('admin')->attempt(['username' => $request->email, 'password' => $request->password], $request->remember)){
                //redirect to dashboard
                session()->flash('success', 'Successfully Logged in !');
                return redirect()->intended(route('admin.dashboard'));
            }
            //error
            session()->flash('error', 'Invalid email and password');
            return back();
        }
        
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }


}
