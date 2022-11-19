<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Mobile;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index($id){
//        $model = Customer::find($id)->mobile;
//        die($model);

        $model = Mobile::find($id)->customer;

        die($model);
    }
}
