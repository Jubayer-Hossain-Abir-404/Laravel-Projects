<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Mobile;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function add_customer(){
        $mobile = new Mobile();
        $mobile->model = 'LG102';

        $customer = new Customer();
        $customer->name = 'Karim';
        $customer->email = 'karim@gmail.com';

        $customer->save();

        $customer->mobile()->save($mobile);

    }

    public function show_customer($id){
        $customer = Customer::find($id);
        return view("customer", ["customer"=>$customer]);
    }
}
