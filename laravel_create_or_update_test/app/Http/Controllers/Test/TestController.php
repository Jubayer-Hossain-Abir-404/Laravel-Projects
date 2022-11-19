<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Models\CrtOrUp;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $test_table = CrtOrUp::latest()->first();

        return view('index.index', compact('test_table'));
    }

    public function store(Request $request)
    {
        request()->validate([

            'name' => 'required|max:255',

            'email' => 'required|email|max:255',
        ]);
        // $test = new CrtOrUp();
        $name = $request->name;
        $email = $request->email;
        $unique_key = 'bah_mid_sub_title_bn';
        // foreach($request->name as $unique_key => $key)
        // {
        //     CrtOrUp::updateOrCreate(['unique_key' =>$key], ['name' => $name, 'email' => $email]);
        // }
        $check_key = CrtOrUp::where('unique_key',$unique_key)->first();
        if ($check_key != null ){
            CrtOrUp::where(['unique_key' => $unique_key])->update([
                'name' => $name,
                'email' => $email
            ]);
        }else{
            CrtOrUp::updateOrCreate([
            'unique_key' => $unique_key,
            'name' => $name,
            'email' => $email
            ]);
        }

        return redirect()->route('index');
    }
}
