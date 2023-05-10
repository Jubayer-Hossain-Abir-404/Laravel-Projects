<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    public function productList()
    {
        $products = Product::all();
        $header = 'Product List';
        return view('products', compact('products', 'header'));
    }
}