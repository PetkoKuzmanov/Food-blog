@extends('layouts.app')

@section('title', "Post Details")

@section('content')
    <ul>
        <li>Title: {{ $post->title }}</li>
        <li>Content: {{ $post->content }}</li>
        <li>Author: <a href="{{ route('users.show', ['id' => $post->user->id]) }}">{{ $post->user->name}}</a></li>
        <li>Tags:</li>
            <ul>
                @foreach ($post->tags as $tag)
                    <li><a href="{{ route('tags.show', ['id' => $tag->id]) }}">{{ $tag->name}}</a></li>
                @endforeach
            </ul>

        <li>Images:</li>
            <ul>
                @foreach ($post->images as $image)
                    <li>{{ $image->url}}</li>
                @endforeach
            </ul>

        <li>Ingredients:</li>
            <ul>
                @foreach ($post->ingredients as $ingredient)
                    <li>{{ $ingredient->name}} {{ $ingredient->amount}}{{ $ingredient->measurement}}</li>
                @endforeach
            </ul>

        <li>Comments:</li>
            <ul>
                @foreach ($post->comments as $comment)
                    <li><a href="{{ route('users.show', ['id' => $comment->user->id]) }}">{{ $comment->user->name}}</a> <br> {{ $comment->content}}</li>
                @endforeach
            </ul>
    </ul>
@endsection