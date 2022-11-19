<?php

namespace App\Http\Controllers\UserTable2;

use App\Http\Controllers\Controller;
use App\Models\UserTable;
use Illuminate\Http\Request;

class UserTable2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_table = UserTable::latest('id')->get();

        return view('home.index', compact('user_table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',

            'email' => 'required|email|max:255',

            'image' => 'required'
        ]);


        $input = $request->all();

        $image = $request->file('image');
        if($image!=null){
            $image_name = rand(123456, 999999) . '.' . $image->getClientOriginalExtension();
            $image_path = public_path('/images');
            $image->move($image_path, $image_name);

            $input['image'] = $image_name;
        }

        UserTable::create($input);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(UserTable $user_table)
    {
        return view('edit.edit', compact('user_table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserTable $user_table)
    {
        $this->validate($request, [
            'name' => 'required|max:255',

            'email' => 'required|email|max:255',
        ]);


        $input = $request->all();

        $image = $request->file('image');
        if($image!=null){
            $image_name = rand(123456, 999999) . '.' . $image->getClientOriginalExtension();
            $image_path = public_path('/images');
            $image->move($image_path, $image_name);

            $input['image'] = $image_name;
        }

        $user_table->update($input);

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTable $user_table)
    {
//        dd($user_table);
        $user_image = $user_table->image;
        $image_path = public_path('images/'. $user_image);
        unlink($image_path);

        $user_table->delete();

        return redirect()->route('home');
    }
}
