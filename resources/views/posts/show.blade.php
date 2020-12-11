@extends('layouts.app')

@section('title', "Post Details")

@section('content')
    <ul>
        <li>Title: {{ $post->title }}</li>
        <li>Content: {{ $post->content }}</li>
        <li>Posted by: <a href="{{ route('users.show', ['user' => $post->user->id]) }}">{{ $post->user->name}}</a></li>
        <li>Tags:</li>
            <ul>
                @foreach ($post->tags as $tag)
                    <li><a href="{{ route('tags.show', ['tag' => $tag->id]) }}">{{ $tag->name}}</a></li>
                @endforeach
            </ul>

        <li>Images:</li>
            <ul>
                @foreach ($post->images as $image)
                    <img src="{{ asset('/images/'.$image->url) }}">
                @endforeach
            </ul>

        <li>Ingredients:</li>
            <ul>
                @foreach ($post->ingredients as $ingredient)
                    <li>{{ $ingredient->name}} {{ $ingredient->amount}}{{ $ingredient->measurement}}</li>
                @endforeach
            </ul>

        <li>Comments:
            @if (count($post->comments) > 0) 
            
                <ul>
                    @foreach ($post->comments as $comment)
                        <li>{{ $comment->content}} <br> Posted by: <a href="{{ route('users.show', ['user' => $comment->user->id]) }}">{{ $comment->user->name}}</a></li>
                    @endforeach
                </ul>
        
            @else
                No comments
            @endif
        </li>

        <form method="POST"
            action="{{ route('posts.destroy', ['post' => $post->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">DELETE</button>
        </form>
    </ul>
@endsection