<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index(){
        return view('profile');
    }

    public function profileUpdate(Request $request){
        $request->validate([
            'name' => ['required', 'max:255'],
            'phone_number' => ['required'],
            'email' => ['required', 'email:rfc,dns', Rule::unique('users')->ignore(auth()->user()->id)],
        ]);

        $user = User::find($request->hidden_id);
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        if($request->has('password')){
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;
        $user->update();

        return redirect()->route('profile');
    }
}
