<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }
    // public function rules()
    // {
    //     return [
    //         'name' => 'required|max:255',
    //         'username' => 'required|max:255',
    //         'email' => 'required|email:rfc,dns',
    //         'password' => 'required|confirmed',
    //     ];
    // }

    
    public function registerPage()
    {
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
            'úser_name' => request('úser_name'),
            'password' => Hash::make(request('password')),
        ]);

        return redirect()->route('login');
    }

    public function submitLogin(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);
        $user_name = $request->login;
        $password = $request->password;

        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'úser_name';

        if (auth()->attempt([$fieldType => $user_name, 'password' => $password], request()->remember)) {
            $token = auth()->user()->createToken('ajaxApiORM')->plainTextToken;
            session()->put('token', $token);
            return redirect()->route('home');
            // return response()->json(array('message' => 'Login Failed'));
        }
        else{
            return back();
        }
        // return response()->json(array('message' => 'Login Done'));
        
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        auth()->logout();

        return redirect()->route('home');
    }
}
