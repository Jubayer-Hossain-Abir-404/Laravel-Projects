<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Orders;

class CartController extends Controller
{
    public function addItem(Request $request)
    {
        $itemId = $request->input('item_id');
        $itemName = $request->input('item_name');
        $itemPrice = $request->input('item_price');
        $itemQuantity = $request->input('item_quantity');

        // Get the cart from the session
        $cart = session()->get('cart', []);

        // Check if the item is already in the cart
        if (isset($cart[$itemId])) {
            // Update the quantity of the existing item
            $cart[$itemId]['quantity'] += $itemQuantity;
        } else {
            // Add a new item to the cart
            $cart[$itemId] = [
                'name' => $itemName,
                'price' => $itemPrice,
                'quantity' => $itemQuantity
            ];
        }

        // Store the updated cart in the session
        session()->put('cart', $cart);

        $send_cart = session()->get('cart');

        return response()->json($send_cart);
    }

    public function removeCartItem(Request $request)
    {
        $itemId = $request->input('item_id');
        $cart = session()->get('cart');

        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
            session()->put('cart', $cart);
            $send_cart = session()->get('cart');
            return response()->json($send_cart);
        } 
    }

    public function checkout(Request $request){
        $cart_items = session()->get('cart');
        if (!session()->has('cart')) {
            return response()->json(array('message'=> 'No item is added inside the cart'));
        }
        $total_items = count($cart_items);

        $user_id = auth()->user()->id;
        
        
        $max_order_id = DB::table('orders')
                ->selectRaw('IF(MAX(user_order_sl) IS NULL, 1, MAX(user_order_sl)+1) as max_order')
                ->where('user_id', '=', $user_id)
                ->first();
        $time= Carbon::now();
        $flag =0;
        foreach($cart_items as $key => $cart){
            $order = new Orders();
            $order->product_id = $key;
            $order->product_quantity = $cart['quantity'];
            $order->product_price = (int) $order->product_quantity * (float) $cart['price'];
            $order->user_order_sl =  $max_order_id->max_order;
            $order->order_id = $time->year.'-'.$user_id.'-'.$max_order_id->max_order;
            $order->user_id = $user_id;
            $order->save();
            $flag++;
        }

        
        if($flag== $total_items){
            $request->session()->forget('cart');
            return response()->json(array('message'=> 'All the items added'));
        }
        else{
            return response()->json(array('message'=> 'Failed'));
        }

        
    }
}
