@extends('layouts.app')


@section('content')

    <div class="w-8/12  container max-w-full mx-auto pt-4">
        <form action="{{ route('insert') }}" method="post">

            @csrf

            <div class="mb-4">
                <label class="font-bold text-gray-800" for="title">Title: </label>

                <input class="h-10 bg-white border border-gray-300 rounded py-4 px-3 mr-4 w-full text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" id="title" name="title">
            </div>

            <div class="mb-4">
                <label class="font-bold text-gray-800" for="content">Content: </label>

                <textarea class="h-32 bg-white border border-gray-300 rounded py-4 px-3 mr-4 w-full text-gray-600 text-sm focus:outline-none 
                focus:border-gray-400 focus:ring-0" id="content" name="content">
                </textarea>
            </div>

            <button class="bg-blue-500 tracking-wide text-white px-6 py-2 inline-block mb-6 shadow-lg rounded hover:shadow">
                Create
            </button>

            <a href="{{ route('posts') }}" class="bg-gray-500 tracking-wide text-white px-6 py-2 inline-block rounded mb-6 shadow-lg">
                Cancel
            </a>

            
        </form>
    </div>
    
@endsection