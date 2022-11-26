<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function add_author()
    {
        $author = new Author();
        $author->name = 'Jamal';
        $author->save();
    }

    public function show_author($id){
        $post = Post::find($id);
        $author = $post->author;
        return $author;
    }
}
