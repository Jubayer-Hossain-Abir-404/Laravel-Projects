@extends('layouts.app')

@section('content')

{{--    author starts--}}
    <div class="container">
        <h1 class="text-success text-center mt-5">Author</h1>
        <!-- Button trigger modal -->
        <div class="d-flex align-items-end flex-column">
            <button type="button" class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#authorModal">
                Create Author
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="authorModal" tabindex="-1" aria-labelledby="authorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Author</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="authorForm"  enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="authorName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="authorName" name="authorName" placeholder="Author Name" value="">
                            </div>
                            <div id="authorName_error">

                            </div>
                            <div class="mb-3">
                                <label for="authorPhoto" class="form-label">Photo</label>
                                <input type="file" class="form-control" name="authorPhoto" id="authorPhoto" >
                            </div>
                            <div id="authorPhoto_error">

                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
{{--                        <button type="button" class="btn btn-primary" >Save</button>--}}
                        <input type="submit" name="authorSave" id="authorSave" class="btn btn-primary" value="Save">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
