@extends('layouts.app')

@section('title', "Posts")

@section('content')
<div class="d-flex justify-content-center">
    <div>
        <h1 class="display-1">Recipies</h1>
    </div>
    <div>
        @if (session('message'))
        <p><b>{{ session('message')}}</b></p>
        @endif

        <ul class="list-inline">
            @foreach ($posts as $post)
            <li><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
@endsection