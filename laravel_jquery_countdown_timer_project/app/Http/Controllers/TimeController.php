<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function view(){
        return view('view');
    }

    public function create(){
        return view('create');
    }
}
