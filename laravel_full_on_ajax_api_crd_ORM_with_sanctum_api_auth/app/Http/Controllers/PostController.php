<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use URL;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories = Category::latest('id')->get();
        // $authors = Author::latest('id')->get();
        if(Auth::check()){
            return view('post');
        }
        else{
           abort(403, 'You are not authorized to be in this page'); 
        }
        
    }

    public function bin()
    {
        if(Auth::check()){
            return view('postBin');
        }
        else{
           abort(403, 'You are not authorized to be in this page'); 
        }
    }

    public function getCategoryAuthor()
    {
        $categories = Category::latest('name')->get();
        $authors = Author::latest('id')->get();

        $postResult['categories'] = $categories;
        $postResult['authors'] = $authors;

        return response()->json($postResult);
    }

    public function getPost()
    {
        $post = DB::table('posts as p')
            ->selectRaw('p.*, p.id as sl, c.name as categoryName,
        IF(p.approve=1, "Approved", "Disapproved") AS status')
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->whereNull('p.deleted_at')
            ->reorder('p.id', 'desc')
            ->get();

        return response()->json($post);
    }

    public function getBinPost()
    {
        $base_url = URL::to("/");
        $base_url = $base_url."/";
        $post = DB::table('posts as p')
            ->selectRaw("CONCAT('$base_url', p.image) as image, p.title, p.written_by, p.id as sl, c.name as categoryName")
            ->leftJoin("categories as c", "p.category_id", "=", "c.id")
            ->whereNotNull('p.deleted_at')
            ->reorder("p.id", "desc")
            ->get();

        return response()->json($post);
    }

    public function getPostEditData(Request $request)
    {
        $id = $request->post_id;
        $post = Post::find($id);
        return response()->json($post);
    }

    public function changeApprove(Request $request)
    {
        if (Auth::check()) {
            $id = $request->post_id;
            $post = Post::find($id);
            $post->approve = ($post->approve == 1) ? 0 : 1;
            // return response()->json($post);
            if ($post->update()) {
                return response()->json(array('message' => 'Post Approval Updated'));
            } else {
                return response()->json(array('message' => 'Post Approval Update failed'));
            }
        } else {
            // abort(403, 'You are not authorized to do this action');
            return response()->json(['error' => 'You are not authorized to do this action'], 403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'postName' => 'required|max:255',
            'postPhoto' => 'required',
            'postType' => 'required',
            'postAuthor' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }


        $file = $request->file('postPhoto');

        $file_name = rand(123456, 999999) . '.' . $file->getClientOriginalExtension();
        $file_path = public_path('post_files');
        $file->move($file_path, $file_name);

        $post = new Post();
        $post->title = $request->postName;
        $post->image = 'post_files/' . $file_name;

        $post->author_id = $request->postAuthor;
        //        query for fetching author name
        $author = Author::find($post->author_id);
        $post->written_by = $author->name;
        $post->category_id = $request->postType;
        //        checking if postApprove has data
        if ($request->has('postApprove')) {
            $post->approve = $request->postApprove;
        }

        if ($post->save()) {
            return response()->json(array('message' => 'New Post has been created'));
        } else {
            return response()->json(array('message' => 'Failed to create a new post'));
        }
    }

    public function updatePost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'postName' => 'required|max:255',
            'postType' => 'required',
            'postAuthor' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $id = $request->hidden_post_id;
        $post = Post::find($id);

        if ($request->hasFile('postPhoto')) {
            $file = $request->file('postPhoto');
            $file_name = rand(123456, 999999) . '.' . $file->getClientOriginalExtension();
            $file_path = public_path('post_files');
            $file->move($file_path, $file_name);
            $post->image = 'post_files/' . $file_name;
        }
        $post->title = $request->postName;
        $post->author_id = $request->postAuthor;
        //        query for fetching author name
        $author = Author::find($post->author_id);
        $post->written_by = $author->name;
        $post->category_id = $request->postType;
        //        checking if postApprove has data
        if ($request->has('postApprove')) {
            $post->approve = $request->postApprove;
        } else {
            $post->approve = 0;
        }

        if ($post->update()) {
            return response()->json(array('message' => 'Post has been updated'));
        } else {
            return response()->json(array('message' => 'Failed to update post'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->post_id;
        $post = Post::find($id);

        // to delete file from folder
        $file_name = $post->image;
        $file_path = public_path($file_name);
        unlink($file_path);

        if ($post->forceDelete()) {
            return response()->json(array('message' => 'Post has been deleted'));
        } else {
            return response()->json(array('message' => 'Failed to delete post'));
        }
    }

    public function softDelete(Request $request)
    {
        $id = $request->post_id;
        $post = Post::find($id);


        if ($post->delete()) {
            return response()->json(array('message' => 'Post has been moved to bin'));
        } else {
            return response()->json(array('message' => 'Failed to move the post to bin'));
        }
    }

    public function restorePost(Request $request){
        $id = $request->post_id;
        $post = Post::withTrashed()->where('id', $id)->restore();

        if($post){
            return response()->json(array('message' => 'Post has been restored'));
        } else{
            return response()->json(array('message' => 'Post failed to be restored'));
        }
    }

    public function restoreMultiplePost(Request $request){
        $ids = $request->post_id;
        $count=0;
        foreach($ids as $key => $id){
            $post = Post::withTrashed()->where('id', $id)->restore();
            if($post){
                $count++;
            }
        }
        if($count = count($ids)){
            return response()->json(array('message' => 'The selected Posts have been restored'));
        } else{
            return response()->json(array('message' => 'The selected Posts failed to be restored'));
        }
    }
}
