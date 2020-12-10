@extends('layouts.app')

@section('title', "User Details")

@section('content')
    <ul>
        <li>Name: {{ $user->name }}</li>
        <li>Email: {{ $user->email }}</li>
        <li>Role: {{ $user->role }}</li>
        <li>Posts:</li>
            <ul>
                @foreach ($user->posts as $post)
                    <li><a href="{{ route('posts.show', ['id' => $post->id]) }}">{{ $post->title }}</a></li>
                @endforeach
            </ul>
    </ul>
@endsection