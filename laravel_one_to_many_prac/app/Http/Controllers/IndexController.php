<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function single_data($id){
        $author = Author::find($id);
        var_dump($author->name);
        $posts = $author->post;
        foreach($posts as $key=>$post){
            var_dump($post->title);
        }
    }

    public function all_data(){
        $auhtors = Author::all();
        foreach($auhtors as $author){
            var_dump($author->name);
            $posts = $author->post;
            echo "<br>";
            foreach($posts as $key=>$post){
                var_dump($post->title);
                echo "<br>";
            }
            echo "<br>";
            echo "<br>";

        }
    }
}
