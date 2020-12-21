@extends('layouts.app')

@section('title', "Edit Post")

@section('content')
<form method="POST" action="{{ route('posts.update', [ 'post' => $post]) }}" enctype="multipart/form-data" action="/details">
    @csrf
    @method('PUT')
    <label class="h1">Title:</label>
    <div class="input-group">
        <textarea type="text" name="title" class="form-control" aria-describedby="title-textarea">{{ $post->title }}</textarea>
    </div>

    <label class="h2">Content:</label>
    <div class="input-group">
        <textarea style="height:300px;" type="text" name="content"class="form-control" aria-describedby="content-textarea">{{ $post->content }}</textarea>
    </div>

    <label class="h2">Tags:</label>
    <br>
        <select size="5" name="tags[]" v-for="item in items" multiple>
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}" @if ($post->tags->contains($tag))
                selected="selected"
                @endif
                >{{ $tag->name }}</option>
            @endforeach
        </select>
    <br>

    <label class="h2">Nutritional info:</label>
    <br>
    <label class="h2">Serving size:</label>
    <div class="input-group">
        <textarea type="text" name="servingSize" class="form-control" aria-describedby="serving-size-textarea">{{ $post->nutritionalInfo->servingSize }}</textarea>
    </div>
    <label class="h2">Calories:</label>
    <div class="input-group">
        <textarea type="text" name="calories" class="form-control" aria-describedby="calories-textarea">{{ $post->nutritionalInfo->calories }}</textarea>
    </div>
    
    <br>

    <h2>Images:</h2>
    <ul>
        @foreach ($post->images as $image)
        <img alt="Post image" src="{{ asset('/images/'.$image->url) }}" width="200" height="200">
        @endforeach
    </ul>
    <div class="custom-file mb-3">
        <input type="file" class="custom-file-input" id="inputGroupFile01" name="images[]" multiple aria-describedby="images-input">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
    </div>
    <br>

    <input class="btn btn-success" type="submit" value="Submit">
    <a class="btn btn-danger" href="{{ route('posts.show', [ 'post' => $post]) }}">Cancel</a>
</form>
@endsection