<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CountdownTimer;

class TimeController extends Controller
{
    public function view(){
        $countdown_timer = CountdownTimer::first();
        return view('view', compact('countdown_timer'));
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){
        $time_key = '1';
        $countdown_timer = CountdownTimer::findOrNew($time_key);
        $countdown_timer->launch_date = $request->launch_date;

        $countdown_timer->status = $request->status;
        if($countdown_timer->save()){
            return back()->with('success', 'Time save Successfull');
        }else{
            return back()->with('error', 'Timer save failed');
        }
    }
}
