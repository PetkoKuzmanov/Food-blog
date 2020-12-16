@extends('layouts.app')

@section('title', "Create a post")

@section('content')
<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" action="/details">
    @csrf
    <h1 class="form-label">Title: <input class="input-group-text" type="text" name="title" value="{{ old('title') }} " class="form-control"></h1>

    <h2 class="form-label">Content: <input class="input-group-text" type="text" name="content" value="{{ old('content') }}" class="form-control"></h2>

    <div id="tags-select">
        <h2 class="form-label">Tags: </h2>
        <select name="tags[]" v-for="item in items" multiple size="5">
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}" @if ($tag->id == old('tag_id'))
                selected="selected"
                @endif
                >{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>
    <br>
    <h2>Images:</h2>
    <div class="input-group mb-3">
        <input type="file" name="images[]" class="form-control" aria-describedby="inputGroupFileAddon03" multiple>
    </div>

    <input class="btn btn-success" type="submit" value="Submit" class="btn btn-primary">
    <a class="btn btn-danger" href="{{ route('posts.index') }}">Cancel</a>
</form>


<!-- <script>
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
</script> -->
@endsection