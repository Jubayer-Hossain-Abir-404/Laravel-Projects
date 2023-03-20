<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        return view('profile');
    }

    public function profileUpdate(Request $request){
        $request->validate([

            'name' => 'required|max:255',
            'phone_number' => 'required',
            'email' => 'required|email:rfc,dns|unique:users',
        ]);

        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'phone_number' => request('phone_number'),
            'password' => Hash::make(request('password')),
        ]);

        return redirect()->route('login');
    }
}
