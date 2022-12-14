@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-success text-center mt-5">Create Post</h1>

        <!-- Button trigger modal -->
        <div class="d-flex align-items-end flex-column">
            <button type="button" class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#postModal">
                Create Post
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="postSuccessMessage"></div>
                    <div class="modal-body">
                        <form method="post" id="postForm" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="postName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="postName" name="postName" placeholder="Post Name" value="">
                            </div>
                            <div  id="postName_error"></div>

                            <div class="mb-3">
                                <label for="postPhoto" class="form-label">Image</label>
                                <input type="file" class="form-control" name="postPhoto" id="postPhoto" >
                            </div>
                            <div id="postPhoto_error"></div>

                            <div class="mb-3">
                                <label for="postType" class="form-label">Select Post Type</label>
                                <select class="form-select" aria-label="Default select example" id="postType" name="postType">
                                    <option value="" selected>Select Post Type</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="postType_error"></div>

                            <div class="mb-3">
                                <label for="postAuthor" class="form-label">Select Post Author</label>
                                <select class="form-select" aria-label="Default select example" id="postAuthor" name="postAuthor">
                                    <option value="" selected>Select Post Author</option>
                                    @foreach($authors as $author)
                                        <option value="{{$author->id}}">{{$author->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="postAuthor_error"></div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="postApprove" id="postApprove">
                                <label class="form-check-label" for="postApprove">
                                    Display Post
                                </label>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" name="postSave" id="postSave" class="btn btn-primary" value="Save">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
