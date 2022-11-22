<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index($id){
        $author = Author::find($id);
//        var_dump($author->post);
        foreach($author->post as $key=>$value){
            var_dump($value->title);
            var_dump($key);
        }
    }
}
