<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class HomeController extends Controller
{
    public function index(){
        return view('index');
    }

    public function addCart(Request $request){
        // Cart::add([
        //     ['id' => $request->id, 'name' => $request->product_name, 'qty' => $request->quantity, 'price' => $request->price, 'options' => ['color' => $request->color, 'size'=> $request->size]]
        // ]);
        $test = array();
        $test= [
            ['id' => 1, 'name' => 'sdhbsh', 'qty' => 2, 'price' => 10, 'options' => ['size' => 'large', 'color'=>'blue']],
            ['id' => 2, 'name' => 'blue', 'qty' => 2, 'price' => 10, 'options' => ['size' => 'large', 'color'=>'red']],
        ];
        foreach($test as $row){
            Cart::add([
                ['id' => $row['id'], 'name' => $row['name'], 'qty' => $row['qty'], 'price' => $row['price'], 'options'=> $row['options']]
            ]);
        }
        // Cart::add([
        //     ['id' => '293ad', 'name' => 'Product 1', 'qty' => 1, 'price' => 10.00],
        //     ['id' => '4832k', 'name' => 'Product 2', 'qty' => 1, 'price' => 10.00, 'options' => ['size' => 'large']]
        // ]);
        return response()->json(Cart::content());
    }
}
