@extends('layouts.app')

@section('title', "Create Post")

@section('content')
<div class="d-flex justify-content-center">
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" action="/details">
        @csrf
        <label class="form-label">Title: </label>
        <input type="text" name="title" value="{{ old('title') }} " class="form-control">

        <label class="form-label">Content: </label>
        <input type="text" name="content" value="{{ old('content') }}" class="form-control">

        <div id="tags-select">
            <label class="form-label">Tags: </label>
            <br>
            <select name="tags[]" v-for="item in items" multiple class="form-select form-select-lg mb-3" size="5">
                @foreach ($tags as $tag)
                <option value="{{ $tag->id }}" @if ($tag->id == old('tag_id'))
                    selected="selected"
                    @endif
                    >{{ $tag->name }}</option>
                @endforeach
            </select>

            <br>
            <button type="button" v-on:click="add" class="btn btn-success">
                +Add a tag
            </button>
            <button type="button" v-on:click="remove" class="btn btn-danger">
                -Remove a tag
            </button>

        </div>
        <label class="form-label">Images: </label>
            <div class="input-group mb-3">
                <input type="file" name="images[]" class="form-control" aria-describedby="inputGroupFileAddon03" multiple>
                <label class="input-group-text" for="images[]">Upload</label>
            </div>

        <input type="submit" value="Submit" class="btn btn-primary">
        <a class="btn btn-primary" href="{{ route('posts.index') }}">Cancel</a>
    </form>
</div>
<script>
    new Vue({
        el: '#tags-select',
        data: {
            items: [],
            item: ['<select name="tags"> </select>'],
        },
        created() {
            this.items.push(this.item);
        },
        methods: {
            add() {
                this.items.push(this.item);
            }
        }
    })
</script>
@endsection