<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
        // $request->validate([
        //     'login' => 'required',
        //     'password' => 'required',
        // ]);
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['message'=>$validator->errors()], 401);
        }

        $user_name = $request->login;
        $password = $request->password;

        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'úser_name';

        if (auth()->attempt([$fieldType => $user_name, 'password' => $password], request()->remember)) {
            $user = auth()->user();
            $token = $user->createApiToken(); #Generate token
            // return back()->with('status', $user_name . " " . $password);
            // return response()->json(array('message' => 'Login Failed'));
            return response()->json(['status' => 'Authorised', 'token' => $token ], 200);
        }
        else{
            return response()->json(['status'=>'Unauthorised'], 401);
        }
        // return response()->json(array('message' => 'Login Done'));
        // return redirect()->route('home');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('home');
    }
}
