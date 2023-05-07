<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class HomeController extends Controller
{
    public function index(){
        return view('index');
    }

    public function addCart(){
        Cart::add('293ad', 'Product 1', 1, 9.99);

        return response()->json(Cart::content());
    }
}
