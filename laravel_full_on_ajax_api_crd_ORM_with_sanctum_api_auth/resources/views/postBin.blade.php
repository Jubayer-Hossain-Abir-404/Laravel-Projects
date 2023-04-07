@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-success text-center mt-5">Post Bin</h1>

        <div class="mt-5">
            <input type="checkbox" value="1" id="all">
            <label for="all">All</label>
        </div>
        <!-- Button trigger modal -->
        <div class="d-flex justify-content-between">
            <div class="mt-2">
                <button type="button" class="btn btn-warning">Restore</button>
                <button type="button" class="btn btn-danger">Permanent Delete</button>
            </div>
            <a href="{{ route('post') }}" type="button" class="btn btn-primary mt-2">
                Back
            </a>
        </div>

        <div id="postTableDiv" class="mt-5" style="overflow-x: auto;">
            <table id="postBinTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Check</th>
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

            $.ajax({
                url: "{{ route('getBinPost') }}",
                type: "GET",
                dataType: 'JSON',
                headers: {
                    'Authorization': 'Bearer ' + token
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
            oTable = $('#postBinTable').DataTable({
                order: [
                    [0, 'desc']
                ],
                destroy: true
            });

            $("#all").on("change", function() {
                let allCheck = document.getElementById("all");
                if (allCheck.checked) {
                    oTable.$("input[type='checkbox']").prop('checked', true);
                } else {
                    oTable.$("input[type='checkbox']").prop('checked', false);
                }

            });

            callPostApi();
        });

        function restoreFunc(id=null) {
            let selectedCheckBox = [];
            $("input:checkbox[name=singlePostCheck]:checked").each(function() {
                selectedCheckBox.push($(this).val());
            });
            console.log(selectedCheckBox.length);
            // if(selectedCheckBox.length==0){

            // }
        }

        function permanentDeleteFunc(id) {
            let confirmAction = confirm("Are you sure to move this post to bin?");
            if (confirmAction) {
                $.ajax({
                    url: "{{ route('softDelete') }}",
                    type: "GET",
                    data: {
                        post_id: id
                    },
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    success: function(data) {
                        alert(data.message);
                        callPostApi();
                    },

                    error: function(data) {
                        let errors = data.responseJSON;
                        console.log(errors);
                    }
                })
            } else {
                alert("Moving to bin cancelled");
            }
        }

        function setAttributes(element, attributes) {
            Object.keys(attributes).forEach(attr => {
                element.setAttribute(attr, attributes[attr]);
            });
        }

        function singleCheck(totalList) {
            let currentCheck = oTable.$("input[type='checkbox']:checked").length;
            let allCheck = document.getElementById("all");
            if (allCheck.checked) {
                if (currentCheck - 1 == totalList) {
                    allCheck.checked = true;
                } else {
                    allCheck.checked = false;
                }
            } else {
                if (currentCheck == totalList) {
                    allCheck.checked = true;
                } else {
                    allCheck.checked = false;
                }
            }

        }


        function populateDataTable(post_data) {
            // clear the table before populating it with more data
            $("#postBinTable").DataTable().clear();
            // console.log(post_data.length);
            post_data.forEach(function(data, key) {
                let post_img = document.createElement("img");
                post_img.setAttribute('src', data.image);
                post_img.style.cssText = "width:200px; height:100px;";

                let restore_button = document.createElement("button");
                restore_button.innerHTML = 'Restore';
                restore_button.classList.add('btn', 'btn-warning', 'mb-2');
                restore_button.setAttribute("id", "edit" + data.sl);
                restore_button.setAttribute('onclick', 'restoreFunc("' + data.sl + '");');

                let permananet_delete_button = document.createElement("button");
                permananet_delete_button.innerHTML = 'Permanent Delete';
                permananet_delete_button.classList.add('btn', 'btn-danger', 'text-nowrap');
                permananet_delete_button.setAttribute("id", "delete" + data.sl);
                permananet_delete_button.setAttribute('onclick', 'permanentDeleteFunc("' + data.sl + '");');

                let action = restore_button.outerHTML + " " + permananet_delete_button.outerHTML;

                const checkBoxAttributes = {
                    type: 'checkbox',
                    value: data.sl,
                    name: 'singlePostCheck',
                    id: 'check' + data.sl,
                    onClick: 'singleCheck("' + post_data.length + '")'
                };

                let checkbox = document.createElement("input");
                setAttributes(checkbox, checkBoxAttributes);

                $('#postBinTable').dataTable().fnAddData([
                    checkbox.outerHTML,
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
