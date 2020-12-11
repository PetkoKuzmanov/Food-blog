@extends('layouts.app')

@section('title', "Create Post")

@section('content')
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" action="/details">
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

        <p>Image: 
            <div class="col-md-6">
                <input type="file" name="image" class="form-control" multiple>
            </div>
        </p>
        
        <input type="submit" value="Submit">
        <a href="{{ route('posts.index') }}">Cancel</a>
    </form>
@endsection