@extends('layouts.app')

@section('title', "User Details")

@section('content')

<ul>
    @if ($user->profilePicture()->exists())
    <img src="{{ asset('/profilePictures/'.$user->profilePicture->url) }}" width="200" height="200">
    @else
    <img src="{{ asset('/profilePictures/defaultProfilePicture.jpg') }}" width="200" height="200">
    @endif

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

    @if (Auth::user() && Auth::user()->id == $user->id)
    <form method="POST" action="{{ route('users.edit', ['user' => $user]) }}">
        @csrf
        @method('PUT')
        <button class="btn-default" type="submit">EDIT</button>
    </form>
    @endif
</ul>
@endsection