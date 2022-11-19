<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class MobileController extends Controller
{
    public function show_mobile($id){
        $mobile = Customer::find($id)->mobile;

        return view('mobile', ['mobile'=>$mobile]);
    }
}
