@extends('layouts.app')


@section('content')

<div class="container">
    <br>

    <h3 align="center">Delete</h3>
    <br>
    <form method="post" action="{{ route('destroy', $user_table->id) }}" enctype="multipart/form-data">
        @method('DELETE')

        @csrf
        <div style="margin-bottom: 20px">
            <h4 class="modal-title">Are you sure you want to delete the user named {{ $user_table->name }} ?</h4>
        </div>
        <div>
        <div>
            {{-- <input type="submit" name="button_insert" id="button_insert" class="btn btn-info" value="Update" /> --}}
            <button class="btn btn-danger">
                Delete
            </button>
            <a class="btn btn-default" href="{{ route('home') }}" role="button">Cancel</a>
        </div>
    </form>
</div>
    
@endsection