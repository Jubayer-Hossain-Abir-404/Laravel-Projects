<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $user;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    public function index()
    {
        if(is_null($this->user) || !$this->user->can('admin.view')){
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
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
        //$roles = Role::all();
        if(is_null($this->user) || !$this->user->can('admin.create')){
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }
        $roles = Role::where('guard_name', getGuardName())->get();
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
        if(is_null($this->user) || !$this->user->can('admin.create')){
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }
//        validation Data
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins',
            'username' => 'required|max:100|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);

        // create new Admin
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);

        $admin->save();

        if($request->roles){
            $admin->assignRole($request->roles);
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
        if(is_null($this->user) || !$this->user->can('admin.edit')){
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }
        $admin = Admin::find($id);
        // $roles = Role::all();
        $roles = Role::where('guard_name', getGuardName())->get();
        return view('backend.pages.admins.edit', compact('admin','roles'));
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
        if(is_null($this->user) || !$this->user->can('admin.edit')){
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }
        // edit Admin
        $admin = Admin::find($id);
        //        validation Data
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->username = $request->username;
        if($request->password){
            $admin->password = Hash::make($request->password);
        }
        

        $admin->save();
        $admin->roles()->detach();
        if($request->roles){
            $admin->assignRole($request->roles);
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
        if(is_null($this->user) || !$this->user->can('admin.delete')){
            abort(403, 'Sorry !! You are Unauthorized to delete any admin !');
        }
        //Process Data
        $Admin = Admin::find($id);
        if(!is_null($Admin)){
            $Admin->delete();
        }

        session()->flash('success', 'Admin has been deleted !!');
        return back();
    }
}
