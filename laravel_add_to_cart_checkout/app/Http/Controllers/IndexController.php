<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class IndexController extends Controller
{
    public function index(){
        $products = Product::latest('id')->get();
        $send_cart = session()->get('cart');
        $price=0;
        foreach($send_cart as $cart){
            $price += (float) $cart['price'] * (float) $cart['quantity']; 
        }
        return view('index', compact('products', 'price'));
    }
}
