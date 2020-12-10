@extends('layouts.app')

@section('title', "Posts")

@section('content')
    <p>The posts of the user:</p>

    @if (session('message'))
        <p><b>{{ session('message')}}</b></p>
    @endif
    
    <ul>
        @foreach ($posts as $post)
            <li><a href="{{ route('posts.show', ['id' => $post->id]) }}">{{ $post->title}}</a></li>
        @endforeach
    </ul>
    <a href=" {{ route('posts.create') }}">Create a post</a>
@endsection