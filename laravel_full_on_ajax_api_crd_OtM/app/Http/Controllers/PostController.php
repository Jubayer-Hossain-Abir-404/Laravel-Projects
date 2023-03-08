<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest('id')->get();
        $authors = Author::latest('id')->get();

        return view('post', compact(
            'categories',
            'authors'
        ));
    }
    
    public function getPost()
    {
        $post = DB::table('posts as p')
        ->selectRaw('p.*, p.id as sl, c.name as categoryName,
        IF(p.approve=1, "Approved", "Disapproved") AS status')
        ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
        ->reorder('p.id', 'desc')
        ->get();
        return response()->json($post);
    }

    public function changeApprove(Request $request){
        $id = $request->post_id;
        $post = Post::find($id);
        $post->approve = ($post->approve==1) ? 0 : 1;
        // return response()->json($post);
        if($post->update()){
            return response()->json(array('message' => 'Post Approval Updated'));
        }
        else{
            return response()->json(array('message' => 'Post Approval Update failed'));
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
        $validator = Validator::make($request->all(),[
            'postName' => 'required|max:255',
            'postPhoto' => 'required',
            'postType' => 'required',
            'postAuthor' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }


        $file = $request->file('postPhoto');

        $file_name = rand(123456, 999999) . '.' . $file->getClientOriginalExtension();
        $file_path = public_path('post_files');
        $file->move($file_path, $file_name);

        $post = new Post();
        $post->title = $request->postName;
        $post->image = 'post_files/'.$file_name;

        $post->author_id = $request->postAuthor;
//        query for fetching author name
        $author = Author::find($post->author_id);
        $post->written_by = $author->name;
        $post->category_id = $request->postType;
//        checking if postApprove has data
        if($request->has('postApprove')) {
            $post->approve = $request->postApprove;
        }

        if($post->save()){
            return response()->json(array('message' => 'New Post has been created'));
        }
        else{
            return response()->json(array('message' => 'Failed to create a new post'));
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
    public function destroy($id)
    {
        //
    }
}
