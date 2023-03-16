<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registerPage(){
        return view('register');
    }

    public function loginPage()
    {
        return view('login');
    }



    public function submitRegister(Request $request)
    {
        // $request->validate([

        //     'name' => 'required|max:255',
        //     'username' => 'required|max:255',
        //     'email' => 'required|email:rfc,dns',
        //     'password' => 'required|confirmed',
        // ]);

        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'phone_number' => request('phone_number'),
            'password' => Hash::make(request('password')),
        ]);

        return redirect()->route('login');
    }

    public function submitLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (!auth()->attempt(['email' => $email, 'password' => $password], request()->remember)) {
            return back()->with('status', $email . " " . $password);
        }
        return redirect()->route('home');
    }
}
