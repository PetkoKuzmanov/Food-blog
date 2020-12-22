@extends('layouts.app')

@section('title', "Tag Details")

@section('content')
    <ul>
        <h3>Name: {{ $tag->name }}</h3>

        <h3>Posts with this tag:</h3>
        @if (count($tag->posts) > 0)
            <ul>
                @foreach ($tag->posts as $post)
                    <p><a class="btn btn-outline-primary" href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></p>
                @endforeach
            </ul>
        @else
        No posts with this tag
        @endif
    </ul>
@endsection