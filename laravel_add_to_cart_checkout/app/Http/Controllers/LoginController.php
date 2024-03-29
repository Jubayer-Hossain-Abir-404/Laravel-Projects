<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }


    public function registerPage(){
        return view('auth.register');
    }

    public function submitRegister(Request $request){
        $request->validate([

            'name' => 'required|max:255',
            'phone_number' => 'required',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required',
        ]);

        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'phone_number' => request('phone_number'),
            'password' => Hash::make(request('password')),
        ]);

        return redirect()->route('login');
    }

    public function submitLogin(Request $request){
        $email = $request->email;
        $password = $request->password;
        
        if(!auth()->attempt(['email' => $email, 'password' => $password], request()->remember)){
            return back()->with('status', $email." ".$password);
        }
        return redirect()->route('home');
    }

    public function logout(){
        Auth::logout();

        return redirect()->route('home');
    }
}
