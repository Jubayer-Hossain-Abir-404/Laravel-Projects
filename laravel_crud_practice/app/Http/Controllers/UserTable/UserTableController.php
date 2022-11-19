<?php

namespace App\Http\Controllers\UserTable;

use App\Http\Controllers\Controller;
use App\Models\UserTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserTableController extends Controller
{
    public function index()
    {

        $user_table = UserTable::latest('id')->get();

        return view('home.index', compact('user_table'));
    }


    public function edit(UserTable $user_table)
    {
        return view('edit.edit', compact('user_table'));
    }

    public function update(UserTable $user_table, Request $request)
    {
        request()->validate([

            'name' => 'required|max:255',

            'email' => 'required|email|max:255',
        ]);

        $input = $request->all();
        if($request->hasFile('image'))
        {
            // $user_img = UserTable::find($user_table);
            // $destination = 'public/images/users'.$user_table->image;

            // if(File::exists($destination))
            // {
            //     File::delete($destination);
            // }

            $file_name = $user_table->image;
            $file_path = public_path('storage/images/users/'. $file_name);
            if(File::exists($file_path)){
                unlink($file_path);
            }
            

            $destination_path = 'public/images/users';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destination_path, $image_name);

            $input['image'] = $image_name;
        }
        

        // $user_table->update([

        //     'name' => request('name'),

        //     'email' => request('email'),
        // ]);
        
        $user_table->update($input);

        return redirect()->route('home');
    }

    // public function create()
    // {
    //     return view('posts.create');
    // }

    public function store(Request $request)
    {
        request()->validate([

            'name' => 'required|max:255',

            'email' => 'required|email|max:255',
        ]);

        $input = $request->all();

        // $input = request()->all();

        if($request->hasFile('image'))
        {
            $destination_path = 'public/images/users';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destination_path, $image_name);

            $input['image'] = $image_name;
        }

        // UserTable::create([
        //     'name' => request('name'),

        //     'email' => request('email'),
        // ]);

        UserTable::create($input);


        return redirect()->route('home');
    }

    public function delete(UserTable $user_table)
    {
        return view('delete.delete', compact('user_table'));
    }

    public function destroy(UserTable $user_table)
    {
        // $destination = 'public/images/users'.$user_table->image;
        // if(File::exists($destination))
        // {
        //         File::delete($destination);
        // }
        $file_name = $user_table->image;
        $file_path = public_path('storage/images/users/'. $file_name);
        unlink($file_path);

        $user_table->delete();

        return redirect()->route('home');
    }
}
