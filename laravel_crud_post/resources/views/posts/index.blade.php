@extends('layouts.app')


@section('content')

    <div class="w-8/12  container max-w-full mx-auto pt-4">
        <h1 class="text-4xl font-bold mb-4">My Blog</h1>

        <a href="{{ route('create') }}" class="bg-blue-500 tracking-wide text-white px-6 py-2 inline-block mb-6 shadow-lg rounded hover:shadow my-4">
            Add Post
        </a>
        @foreach ($posts as $post)
            <article class="mb-2">
                {{-- <h2 class="text-xl font-bold text-gray-900">{{ $post->title }}</h2> --}}

                <a href="{{ route('edit', $post->id) }}" class="text-xl font-bold text-blue-500">{{ $post->title }}</a>

                <p class="text-md text-gray-60">
                    {{ $post->content }}
                </p>


                <hr class="mt-2">
            </article>
        @endforeach
        
        
    </div>
    
@endsection