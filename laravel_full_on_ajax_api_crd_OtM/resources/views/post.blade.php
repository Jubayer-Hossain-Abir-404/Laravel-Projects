@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-success text-center mt-5">Post</h1>

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
                        <input type="submit" style="display:none;" name="postUpdate" id="postUpdate" class="btn btn-primary" value="Update">
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="postTableDiv" class="mt-5" style="overflow-x: auto;">
            <table id="postTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Title</th>
                        <th>Post Image</th>
                        <th>Author Name</th>
                        <th>Post Category</th>
                        <th>Post Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function cleanDropdown(id) {
            var dropdown = $(id);
            // exclude the empty value option and remove the rest
            dropdown.find('option:not(:first-child)').remove();
        }

        function populateCategoryDropdown(categories, category_id = null) {
            cleanDropdown('#postType');
            categories.forEach(function(category, key) {
                category.id == category_id ? $('#postType').append($('<option>').val(category.id).text(category
                    .name).attr("selected", "selected")) : $('#postType').append($('<option>').val(category.id)
                    .text(category.name));
            });
        }

        function populateAuthorDropdown(authors, author_id = null) {
            cleanDropdown('#postAuthor');
            authors.forEach(function(author, key) {
                author.id == author_id ? $('#postAuthor').append($('<option>').val(author.id).text(author.name)
                    .attr("selected", "selected")) : $('#postAuthor').append($('<option>').val(author.id).text(
                    author.name));
            });
        }

        function getCategoryAuthor(category_id = null, author_id = null) {
            if (category_id == null && author_id == null) {
                $('#exampleModalLabel').text('Create Post');
                $('#hidden_post_id').val('');
                $('#postName').val('');
                $('#postApprove').prop('checked', false);
                $('#updatePhotoPreview').empty();
                $('#postSave').show();
                $('#postUpdate').hide();
            }

            $.ajax({
                url: "api/getCategoryAuthor",
                type: "GET",
                dataType: 'JSON',
                success: function(data) {
                    // console.log(data.post);
                    populateCategoryDropdown(data.categories, category_id);
                    populateAuthorDropdown(data.authors, author_id);
                },

                error: function(data) {
                    let errors = data.responseJSON;
                    console.log(errors);
                }
            })
        }

        function callPostApi() {
            $('#postTable').DataTable({
                order: [
                    [0, 'desc']
                ],
                destroy: true
            });

            $.ajax({
                url: "api/get_post",
                type: "GET",
                dataType: 'JSON',
                success: function(data) {
                    // console.log(data.post);
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

        function setPostEditData(post_up_data) {
            $('#exampleModalLabel').text('Update Post');
            $('#hidden_post_id').val(post_up_data.id);
            $('#postName').val(post_up_data.title);
            $('#postSave').hide();
            $('#postUpdate').show();

            $('#updatePhotoPreview').empty();
            let post_img = document.createElement("img");
            post_img.setAttribute('src', post_up_data.image);
            post_img.style.cssText = "width:120px; height:70px; margin-bottom:10px;";
            document.getElementById('updatePhotoPreview').append(post_img);

            getCategoryAuthor(post_up_data.category_id, post_up_data.author_id);

            post_up_data.approve == 1 ? $('#postApprove').prop('checked', true) : $('#postApprove').prop('checked', false);

            var myModal = new bootstrap.Modal(document.getElementById('postModal'))
            myModal.show();
        }

        function editFunc(id) {
            $.ajax({
                url: "api/getPostEditData",
                type: "GET",
                data: {
                    post_id: id
                },
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                success: function(data) {
                    console.log(data);
                    setPostEditData(data);
                },

                error: function(data) {
                    let errors = data.responseJSON;
                    console.log(errors);
                }
            })
        }

        function approveFunc(id) {
            // console.log(id);
            $.ajax({
                url: "api/changeApprove",
                method: "POST",
                data: {
                    post_id: id
                },
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                success: function(data) {
                    // console.log(data);
                    // location.reload();
                    callPostApi();
                },

                error: function(data) {
                    let errors = data.responseJSON;
                    console.log(errors);
                    // clearing error message
                }
            })
        }

        function populateDataTable(post_data) {
            // clear the table before populating it with more data
            $("#postTable").DataTable().clear();
            post_data.forEach(function(data, key) {
                let post_img = document.createElement("img");
                post_img.setAttribute('src', data.image);
                post_img.style.cssText = "width:200px; height:100px;";

                let approve_button = document.createElement("button");
                approve_button.innerHTML = data.status;
                approve_button.classList.add('btn', 'btn-success');

                approve_button.setAttribute("id", "approve" + data.sl);
                approve_button.setAttribute('onclick', 'approveFunc("' + data.sl + '");');

                let update_button = document.createElement("button");
                update_button.innerHTML = 'Update';
                update_button.classList.add('btn', 'btn-warning', 'mb-2');
                update_button.setAttribute("id", "edit" + data.sl);
                update_button.setAttribute('onclick', 'editFunc("' + data.sl + '");');

                let delete_button = document.createElement("button");
                delete_button.innerHTML = 'Delete';
                delete_button.classList.add('btn', 'btn-danger');

                let action = update_button.outerHTML + " " + delete_button.outerHTML;

                $('#postTable').dataTable().fnAddData([
                    data.sl,
                    data.title,
                    post_img.outerHTML,
                    data.written_by,
                    data.categoryName,
                    approve_button.outerHTML,
                    action
                ]);
            })
        }
    </script>
@endsection
