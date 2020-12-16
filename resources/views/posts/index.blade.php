@extends('layouts.app')

@section('title', "Recipies")

@section('content')
<div>
    @if (session('message'))
    <p><b>{{ session('message')}}</b></p>
    @endif

    @foreach ($posts as $post)
    <p><a class="btn btn-outline-primary" href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title}}</a></p>
    @endforeach

    <br>

    {{ $posts->links() }}
</div>
@endsection