@extends('layouts.app')

@section('title', "Edit Post")

@section('content')
<form method="POST" action="{{ route('posts.update', [ 'post' => $post]) }}" enctype="multipart/form-data" action="/details">
    @csrf
    @method('PUT')
    <p>Title: <input type="text" name="title" value="{{ $post->title }}"></p>
    <p>Content: <input type="text" name="content" value="{{ $post->content }}"></p>

    <div id="tags-select">
        <p>Tags:
            <select name="tags[]" v-for="item in items" multiple>
                @foreach ($tags as $tag)
                <option value="{{ $tag->id }}" @if ($post->tags->contains($tag))
                    selected="selected"
                    @endif
                    >{{ $tag->name }}</option>
                @endforeach
            </select>
        </p>

        <button type="button" v-on:click="add">
            +Add a tag
        </button>
        <button type="button" v-on:click="remove">
            -Remove a tag
        </button>

    </div>
    <p>Images:
        <ul>
            @foreach ($post->images as $image)
                <img src="{{ asset('/images/'.$image->url) }}" width="200" height="200">
                <!-- <input type="text" name="images[]" class="form-control" value="{{ asset('/images/'.$image->url) }}" hidden> -->
            @endforeach
        </ul>
        <div class="col-md-6">
            <input type="file" name="images[]" class="form-control" multiple>
        </div>
    </p>

    <input type="submit" value="Submit">
    <a href="{{ route('posts.index') }}">Cancel</a>
</form>

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