@extends('layouts.app')

@section('title', "Posts")

@section('content')
<div class="container mt-1">
    <p>The posts of the website:</p>

    @if (session('message'))
    <p><b>{{ session('message')}}</b></p>
    @endif

    <ul>
        @foreach ($posts as $post)
        <li><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title}}</a></li>
        @endforeach
    </ul>

    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
@endsection