<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class IndexController extends Controller
{
    public function index(){
        $products = Product::latest('id')->get();
        $price = 0;
        if(session()->has('cart')){
            $send_cart = session()->get('cart');
            foreach ($send_cart as $cart) {
                $price += (float) $cart['price'] * (float) $cart['quantity'];
            }
        }

        return view('index', compact('products', 'price'));
    }
}
