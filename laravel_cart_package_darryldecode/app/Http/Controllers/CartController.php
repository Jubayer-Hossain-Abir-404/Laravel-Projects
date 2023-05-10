<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        $header = 'Cart';
        return view('cart', compact('cartItems', 'header'));
    }
    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);
        $header = 'Cart';
        session()->flash('success', 'Product is Added to Cart Successfully !');
        return redirect()->route('cart.list')->with( [ 'header' => $header ] );
    }
    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );
        $header = 'Cart';
        session()->flash('success', 'Item Cart is Updated Successfully !');
        return redirect()->route('cart.list')->with( [ 'header' => $header ] );
    }
    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        $header = 'Cart';
        session()->flash('success', 'Item Cart Remove Successfully !');
        return redirect()->route('cart.list')->with( [ 'header' => $header ] );
    }
    public function clearAllCart()
    {
        \Cart::clear();
        $header = 'Cart';
        session()->flash('success', 'All Item Cart Clear Successfully !');
        return redirect()->route('cart.list')->with( [ 'header' => $header ] );
    }
}