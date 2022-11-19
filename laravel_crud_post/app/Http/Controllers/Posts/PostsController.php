<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        // dd(Post::all());

        $posts = Post::latest('id')->get();
        // Project::latest('created_at')->get(
        // return view('posts.index',[
        //     'posts' => $posts
        // ]);

        return view('posts.index', compact('posts'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post)
    {
        // this request gets an instance of the current request or an input
        // item from the request
        // dd(request()->all());

        request()->validate([

            'title' => 'required',

            'content' => 'required',
        ]);
        

        $post->update([
            // here title is from the database field
            // and the request(title) is taken from the input
            'title' => request('title'),

            'content' => request('content'),
        ]);


        return redirect()->route('posts');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        request()->validate([

            'title' => 'required',

            'content' => 'required',
        ]);
        

        Post::create([
            // here title is from the database field
            // and the request(title) is taken from the input
            'title' => request('title'),

            'content' => request('content'),
        ]);


        return redirect()->route('posts');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts');
    }
}
