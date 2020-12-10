@extends('layouts.app')

@section('title', "Create Post")

@section('content')
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <p>Title: <input type="text" name="title" 
            value="{{ old('title') }}"></p>
        <p>Content: <input type="text" name="content"
            value="{{ old('content') }}"></p>

        <p>Tag: 
            <select name="tag_id">
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}"
                        @if ($tag->id == old('tag_id'))
                            selected="selected"
                        @endif
                    >{{ $tag->name }}</option>
                @endforeach
            </select>
            <button type="button">
                +Add a tag
            </button>
        </p>

        
        <input type="submit" value="Submit">
        <a href="{{ route('posts.index') }}">Cancel</a>
    </form>
@endsection