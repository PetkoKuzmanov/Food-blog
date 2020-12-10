@extends('layouts.app')

@section('title', "Tag Details")

@section('content')
    <ul>
        <li>Name: {{ $tag->name }}</li>

        <li>Posts that have this tag:</li>
            <ul>
            @foreach ($tag->posts as $post)
                <li><a href="{{ route('posts.show', ['id' => $post->id]) }}">{{ $post->title}}</a></li>
            @endforeach
            </ul>
    </ul>
@endsection