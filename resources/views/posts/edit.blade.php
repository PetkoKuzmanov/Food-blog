@extends('layouts.app')

@section('title', "Edit Post")

@section('content')
<form method="POST" action="{{ route('posts.update', [ 'post' => $post]) }}" enctype="multipart/form-data" action="/details">
    @csrf
    @method('PUT')
    <h1>Title: <input class="input-group-text" type="text" name="title" value="{{ $post->title }}"></h1>
    <h2>Content: <input class="input-group-text" type="text" name="content" value="{{ $post->content }}"></h2>

    <div id="tags-select">
        <h2>Tags:</h2>
        <select size="5" name="tags[]" v-for="item in items" multiple>
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}" @if ($post->tags->contains($tag))
                selected="selected"
                @endif
                >{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>
    <br>
    <h2>Images:</h2>
    <ul>
        @foreach ($post->images as $image)
        <img src="{{ asset('/images/'.$image->url) }}" width="200" height="200">
        <!-- <input type="text" name="images[]" class="form-control" value="{{ asset('/images/'.$image->url) }}" hidden> -->
        @endforeach
    </ul>
    <div class="input-group">
        <input class="form-control" type="file" name="images[]" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" multiple>
    </div>
    <br>

    <input class="btn btn-success" type="submit" value="Submit">
    <a class="btn btn-danger" href="{{ route('posts.show', [ 'post' => $post]) }}">Cancel</a>
</form>
@endsection