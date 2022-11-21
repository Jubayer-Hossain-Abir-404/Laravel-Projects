<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function add_author(){
        $author = new Author();
        $author->username = 'Jamal';
        $author->password = 'Jamal12';

        $author->save();
    }

//    get author based on post id
    public function show_author($id){
        $author = Post::find($id)->author;
        return $author;
    }
}
