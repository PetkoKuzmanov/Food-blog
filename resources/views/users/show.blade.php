@extends('layouts.app')

@section('title', "User Details")

@section('content')
<ul>
    <img src="{{ asset('/images/'.$user->profilePicture) }}" width="200" height="200">
    <li>Name: {{ $user->name }}</li>
    <li>Email: {{ $user->email }}</li>
    <li>Role: {{ $user->role }}</li>
    <li>Posts:

        @if (count($user->posts) > 0)
        <ul>
            @foreach ($user->posts as $post)
            <li><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></li>
            @endforeach
        </ul>
        @else
        No Posts
        @endif
    </li>
</ul>
@endsection