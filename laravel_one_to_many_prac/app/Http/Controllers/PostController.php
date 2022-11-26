<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function add_post($id){
        $author = Author::find($id);
//        var_dump($author);
        $post = new Post();
        $post->title = 'Title 3';
        $author->post()->save($post);

    }

    public function show_post($id){
        $author = Author::find($id);
        $post = $author->post;
        return $post;
    }
}
