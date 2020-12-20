@extends('layouts.app')

@section('title', "User Details")

@section('content')

<ul>
    <h1>{{ $user->name }}</h1>

    @if ($user->image()->exists())
    <img alt="Profile picture" src="{{ asset('/profilePictures/'.$user->image->url) }}" width="200" height="200">
    @else
    <img alt="Default profile picture" src="{{ asset('/profilePictures/defaultProfilePicture.jpg') }}" width="200" height="200">
    @endif
    <br>

    <h3>Role: {{ $user->role }}</h3>

    <h3>Posts:</h3>

    @if (count($user->posts) > 0)
    <ul>
        @foreach ($user->posts as $post)
        <p><a class="btn btn-outline-primary" href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></p>
        @endforeach
    </ul>
    @else
    No Posts
    @endif

    @if (Auth::user() && Auth::user()->id == $user->id)
    <form method="POST" action="{{ route('users.edit', ['user' => $user]) }}">
        @csrf
        @method('PUT')
        <button class="btn btn-primary" type="submit">Edit profile</button>
    </form>
    @endif
</ul>
@endsection