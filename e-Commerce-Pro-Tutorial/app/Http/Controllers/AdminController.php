<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class AdminController extends Controller
{
    public function view_category(){
        $data = Category::all();
        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request){
        $data = new Category;

        $data->category_name = $request->category;

        $data->save();

        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function delete_category($id){
        $category = Category::find($id);

        $category->delete();

        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }

    public function add_product(){
        return view('admin.add_product');
    }
}
