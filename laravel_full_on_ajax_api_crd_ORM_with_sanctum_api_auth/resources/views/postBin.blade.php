@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-success text-center mt-5">Post Bin</h1>

        <!-- Button trigger modal -->
        <div class="d-flex align-items-end flex-column">
            <button type="button" onclick=getCategoryAuthor(); class="btn btn-primary mt-5" data-bs-toggle="modal"
                data-bs-target="#postModal">
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
                            <input type="hidden" id="hidden_post_id" name="hidden_post_id" value="">
                            <div class="mb-3">
                                <label for="postName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="postName" name="postName"
                                    placeholder="Post Name" value="">
                            </div>
                            <div id="postName_error"></div>

                            <div class="mb-3">
                                <label for="postPhoto" class="form-label">Image</label>
                                <input type="file" class="form-control" name="postPhoto" id="postPhoto" value="">
                            </div>
                            <div id="updatePhotoPreview"></div>
                            <div id="postPhoto_error"></div>

                            <div class="mb-3">
                                <label for="postType" class="form-label">Select Post Type</label>
                                <select class="form-select" aria-label="Default select example" id="postType"
                                    name="postType">
                                    <option value="">Select Post Type</option>
                                </select>
                            </div>
                            <div id="postType_error"></div>

                            <div class="mb-3">
                                <label for="postAuthor" class="form-label">Select Post Author</label>
                                <select class="form-select" aria-label="Default select example" id="postAuthor"
                                    name="postAuthor">
                                    <option value="">Select Post Author</option>
                                </select>
                            </div>
                            <div id="postAuthor_error"></div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="postApprove"
                                    id="postApprove">
                                <label class="form-check-label" for="postApprove">
                                    Display Post
                                </label>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" name="postSave" id="postSave" class="btn btn-primary" value="Save">
                        <button onclick="updatePostForm();" style="display:none;" name="postUpdate" id="postUpdate"
                            type="button" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- @php 
            $token = session()->get('token');
            echo $token."------";
        @endphp --}}
        <div id="postTableDiv" class="mt-5" style="overflow-x: auto;">
            <table id="postTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Title</th>
                        <th>Post Image</th>
                        <th>Author Name</th>
                        <th>Post Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function callPostApi() {
            let token = '{{ session()->get('token') }}';
            // console.log(token);
            $('#postTable').DataTable({
                order: [
                    [0, 'desc']
                ],
                destroy: true
            });
            
            
            $.ajax({
                url: "{{ route('getBinPost') }}",
                type: "GET",
                dataType: 'JSON',
                headers: {
                    'Authorization': 'Bearer '+ token
                },
                success: function(data) {
                    populateDataTable(data);
                },

                error: function(data) {
                    let errors = data.responseJSON;
                    console.log(errors);
                }
            })
        }
        $(document).ready(function() {
            callPostApi();
        });


        function populateDataTable(post_data) {
            // clear the table before populating it with more data
            $("#postTable").DataTable().clear();
            console.log(post_data);
            post_data.forEach(function(data, key) {
                let post_img = document.createElement("img");
                post_img.setAttribute('src', data.image);
                post_img.style.cssText = "width:200px; height:100px;";



                let update_button = document.createElement("button");
                update_button.innerHTML = 'Update';
                update_button.classList.add('btn', 'btn-primary', 'mb-2');
                update_button.setAttribute("id", "edit" + data.sl);
                update_button.setAttribute('onclick', 'editFunc("' + data.sl + '");');

                let delete_button = document.createElement("button");
                delete_button.innerHTML = 'Soft Delete';
                delete_button.classList.add('btn', 'btn-warning');
                delete_button.setAttribute("id", "delete" + data.sl);
                delete_button.setAttribute('onclick', 'deleteFunc("' + data.sl + '");');

                let action = update_button.outerHTML + " " + delete_button.outerHTML;

                $('#postTable').dataTable().fnAddData([
                    data.sl,
                    data.title,
                    post_img.outerHTML,
                    data.written_by,
                    data.categoryName,
                    action
                ]);
            })
        }
    </script>
@endsection
