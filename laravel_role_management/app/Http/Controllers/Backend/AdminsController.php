<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return view('backend.pages.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.pages.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        validation Data
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);

        // create new Admin
        $Admin = new Admin();
        $Admin->name = $request->name;
        $Admin->email = $request->email;
        $Admin->password = Hash::make($request->password);

        $Admin->save();

        if($request->roles){
            $Admin->assignRole($request->roles);
        }

        session()->flash('success', 'Admin has been created !!');
        return redirect()->route('admin.admins.index');
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
    public function edit($id)
    {
        $Admin = Admin::find($id);
        $roles = Role::all();
        return view('backend.pages.admins.edit', compact('Admin','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // edit Admin
        $Admin = Admin::find($id);
        //        validation Data
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        
        $Admin->name = $request->name;
        $Admin->email = $request->email;
        if($request->password){
            $Admin->password = Hash::make($request->password);
        }
        

        $Admin->save();
        $Admin->roles()->detach();
        if($request->roles){
            $Admin->assignRole($request->roles);
        }

        session()->flash('success', 'Admin has been updated !!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Process Data
        $Admin = Admin::find($id);
        if(!is_null($Admin)){
            $Admin->delete();
        }

        session()->flash('success', 'Admin has been deleted !!');
        return back();
    }
}
