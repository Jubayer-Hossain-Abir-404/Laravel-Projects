@extends('layouts.app')

@section('content')
    {{--    author starts --}}
    <div class="container">
        <h1 class="text-success text-center mt-5">Category</h1>
        <!-- Button trigger modal -->
        <div class="d-flex align-items-end flex-column">
            <button type="button" class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#categoryModal">
                Create Category
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="categorySuccessMessage"></div>
                    <div class="modal-body">
                        <form method="post" id="categoryForm" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="categoryName" name="categoryName"
                                    placeholder="Category Name" value="">
                            </div>
                            <div id="categoryName_error"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" name="categorySave" id="categorySave" class="btn btn-primary" value="Save">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "api/get_category_list",
                type: "GET",
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                },

                error: function(data) {
                    let errors = data.responseJSON;
                    console.log(errors);
                }
            })
        });
    </script>
@endsection
