@extends('admin.layout')

@section('style-content')
    <style>
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .h2Font {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .input_color {
            color: black;
        }

        .center {
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid white;
        }
    </style>
@endsection

@section('admin-content')
    @if (session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">X</button>
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="div_center">
        <h2 class="h2Font">Add Category</h2>

        <form action="{{ route('add_category') }}" method="POST">

            @csrf
            <input class="input_color" type="text" name="category" placeholder="Write category name">

            <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
        </form>
    </div>

    <table class="center">
        <tr>
            <td>Category Name</td>
            <td>Action</td>
        </tr>

        @foreach ($data as $data)
            <tr>
                <td>{{ $data->category_name }}</td>
                <td><a onclick="return confirm('Are You Sure To Delete This?')" href="{{ route('delete_category', $data->id) }}" class="btn btn-danger">Delete</a></td>
            </tr>
        @endforeach

    </table>
@endsection
