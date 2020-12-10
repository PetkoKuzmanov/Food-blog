@extends('layouts.app')

@section('title', "Post Details")

@section('content')
    <ul>
        <li>Title: {{ $post->title }}</li>
        <li>Content: {{ $post->content }}</li>
        <li><a href="{{ route('users.show', ['id' => $post->user->id]) }}">Author: {{ $post->user->name}}</a></li>
    </ul>
@endsection