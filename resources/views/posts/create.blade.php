@extends('layouts.app')

@section('title', "Create a post")

@section('content')
<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" action="/details">
    @csrf
    <label class="h1">Title:</label>
    <div class="input-group">
        <textarea type="text" name="title" class="form-control" aria-describedby="title-textarea">{{ old('title') }}</textarea>
    </div>

    <label class="h2">Content:</label>
    <div class="input-group">
        <textarea style="height:300px;" type="text" name="content"class="form-control" aria-describedby="content-textarea">{{ old('content') }}</textarea>
    </div>

    <label class="h2">Tags:</label>
    <br>
    <select name="tags[]" multiple size="5">
        @foreach ($tags as $tag)
        <option value="{{ $tag->id }}" @if ($tag->id == old('tag_id'))
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
        <textarea type="text" name="servingSize" class="form-control" aria-describedby="serving-size-textarea">{{ old('servingSize') }}</textarea>
    </div>
    <label class="h2">Calories:</label>
    <div class="input-group">
        <textarea type="text" name="calories" class="form-control" aria-describedby="calories-textarea">{{ old('calories') }}</textarea>
    </div>
    <br>

    <label class="h2">Images:</label>
    <div class="custom-file mb-3">
        <input type="file" class="custom-file-input" id="inputGroupFile01" name="images[]" multiple aria-describedby="images-input">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
    </div>

    <input class="btn btn-success" type="submit" value="Submit" class="btn btn-primary">
    <a class="btn btn-danger" href="{{ route('posts.index') }}">Cancel</a>
</form>
@endsection