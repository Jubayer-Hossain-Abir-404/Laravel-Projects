@extends('layouts.app')


@section('content')

<div class="container">
    <br>

    <h3 align="center">Update LARAVEL CRUD TABLE</h3>
    <br>
    <form method="post" action="{{ route('update', $user_table->id) }}" enctype="multipart/form-data">
        @method('PUT')

        @csrf
        <div style="margin-bottom: 20px">
            <h4 class="modal-title">Add Data</h4>
        </div>
        <div>
            <div class="form-group">
                <label>Enter Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user_table->name }}"/>
            </div>
            <div class="form-group">
                <label>Enter Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user_table->email }}"/>
            </div>

            <div class="form-group mt-2">
                <label for="image">Update Image</label>
                <input type="file" name="image" class="form-control-file"><br>
                <img src="{{ asset('storage/images/users/'. $user_table->image) }}" width="120px" height="60px"/>
            </div>
        </div>
        <div>
            <input type="submit" name="button_insert" id="button_insert" class="btn btn-info" value="Update" />
            {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> --}}
            <a class="btn btn-default" href="{{ route('home') }}" role="button">Cancel</a>
        </div>
    </form>
</div>
    
@endsection