@extends('layouts.app')

@section('content')

<div class="container">
    <br>

    <h3 align="center">LARAVEL Update or Insert</h3>
    <br>
    <form method="post"  action="{{ route('store') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
            <h4 class="modal-title">Add Data</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Enter Name</label>
                {{-- this is a ternary operation --}}
                <input type="text" name="name" id="name" class="form-control" value="{{ $test_table!=null ? $test_table->name:'' }}"/>
            </div>
            <div class="form-group">
                <label>Enter Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $test_table!=null ? $test_table->email: '' }}"/>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" name="button_insert" id="button_insert" class="btn btn-info" value="Insert" />
        </div>
    </form>
</div>



@endsection