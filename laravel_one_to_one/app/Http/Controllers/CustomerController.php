<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Mobile;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function add_customer(){
        $mobile = new Mobile();
        $mobile->model = 'LG200';

        $customer = new Customer();
        $customer->name = 'karim';
        $customer->email = 'karim@gmail.com';

        $customer->save();

        $customer->mobile()->save($mobile);
    }

    public function show_mobile($id){
        $mobile = Customer::find($id)->mobile;
//        return $mobile;
//        gonna work here
        return view('mobile', ['mobile'=>$mobile]);
    }
}
