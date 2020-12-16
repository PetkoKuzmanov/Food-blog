@extends('layouts.app')

@section('title', "Tag Details")

@section('content')
    <ul>
        <h3>Name: {{ $tag->name }}</h3>

        <h3>Posts with this tag:</h3>
            <ul>
                @foreach ($tag->posts as $post)
                    <a class="btn btn-outline-primary" href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
                    <br>
                @endforeach
            </ul>
    </ul>
@endsection