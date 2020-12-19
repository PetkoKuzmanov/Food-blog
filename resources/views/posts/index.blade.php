@extends('layouts.app')

@section('title', "Recipies")

@section('content')
<div>
    @if (session('message'))
    <p><b>{{ session('message')}}</b></p>
    @endif

    @foreach ($posts as $post)
    <a class="btn btn-outline-primary" href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title}}</a>
    <br>
        @foreach ($post->images as $image)
        <img alt="Post image" src="{{ asset('/images/'.$image->url) }}" width="100" height="100">
        @endforeach
        <br>
        <br>
    @endforeach
    <br>

    {{ $posts->links() }}
</div>
@endsection