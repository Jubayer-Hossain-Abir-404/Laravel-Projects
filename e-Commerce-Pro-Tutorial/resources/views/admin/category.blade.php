@extends('admin.layout')

@section('style-content')
    <style>
        .div_center{
            text-align: center;
            padding-top: 40px;
        }
        .h2Font{
            font-size: 40px;
            padding-bottom: 40px;
        }
        .input_color{
            color: black;
        }
    </style>
@endsection

@section('admin-content')

    <div class="div_center">
        <h2 class="h2Font">Add Category</h2>

        <form action="{{ route('add_category') }}" method="POST">

            @csrf
            <input class="input_color" type="text" name="category" placeholder="Write category name">

            <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
        </form>
    </div>


@endsection