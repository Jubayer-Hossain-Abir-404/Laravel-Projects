@extends('layouts.app')

@section('content')

<div class="container">
    <br>

    <h3 align="center">LARAVEL CRUD TABLE</h3>
    <br>
    <div align="right" style="margin-bottom:5px;">
        <button type="button" data-toggle="modal" data-target="#crudPractice" class="btn btn-success btn-xs">Add</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                   @foreach ($user_table as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d-m-Y h:i:s A') }}</td>
                            <td>
                                {{-- <img src="{{ URL::asset("images/users/{$user->image}")}}"/> --}}
                                <img src="{{ asset('storage/images/users/'. $user->image) }}" width="120px" height="60px"/>
                            </td>
                            <td>
                                {{-- <button type="button" name="edit" class="btn btn-warning edit" id="{{ $user->id }}">Edit</button> --}}
                                <a class="btn btn-warning edit" href="{{ route('edit', $user->id) }}" role="button">Edit</a>
                            </td>
                            <td>
                                {{-- <button type="button" name="delete" class="btn btn-danger delete">Delete</button> --}}
                                <a class="btn btn-danger delete" href="{{ route('delete', $user->id) }}" role="button">Delete</a>
                            </td>
                        </tr> 
                   @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="crudPractice" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('insert') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Enter Name</label>
                        <input type="text" name="name" id="name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Enter Email</label>
                        <input type="email" name="email" id="email" class="form-control" />
                    </div>
                    <div class="form-group mt-2">
                        <label for="image">Select Image</label>
                        <input type="file" name="image" class="form-control-file">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="button_insert" id="button_insert" class="btn btn-info" value="Insert" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection