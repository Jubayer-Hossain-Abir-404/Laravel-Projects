<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
