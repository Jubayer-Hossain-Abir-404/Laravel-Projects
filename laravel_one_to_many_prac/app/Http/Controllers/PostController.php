<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function add_post($id){
        $author = Author::find($id);
        var_dump($author);
    }
}
