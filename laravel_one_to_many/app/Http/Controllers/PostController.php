<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function add_post($id){
        $author = Author::find($id);
        $post = new Post();
        $post->title = 'Title 4';
        $post->cat = 'Cat 4';
        $author->post()->save($post);
    }

    // get post based on Author ID

    public function show_post($id){
        $post = Author::find($id)->post;
        return $post;
    }
}
