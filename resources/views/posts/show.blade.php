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

    <div id="comments">
        <li>Comments:
            @if (count($post->comments) > 0)
            <ul>
                @foreach ($post->comments as $comment)
                <li>{{ $comment->content }} <br> Posted by: <a href="{{ route('users.show', ['user' => $comment->user->id]) }}">{{ $comment->user->name}}</a></li>
                @endforeach
            </ul>
            @else
            No comments
            @endif
        </li>

        <br>
        <input type="text" id="input" placeholder="Add a comment..." v-model="newCommentContent">
        <button @click="createComment">Comment</button>
    </div>
    <div id="content">
        {{ $post->id }}
    </div>

    <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">DELETE</button>
    </form>
</ul>

<script>
    var app = new Vue({
        el: '#comments',
        data: {
            comments: [],
            comment: [],
        },
        mounted() {
            axios.get("{{ route ('api.comments.index') }}", {
                    // post_id: document.getElementById('content').innerHTML
                    post_id: 7,
                })
                .then(response => {
                    this.comments = response.data;
                })
                .catch(response => {
                    console.log(response);
                })
        },
        methods: {
            createComment: function() {
                axios.post("{{ route ('api.comments.store') }}", {
                        content: this.newCommentContent,
                        // post_id: document.getElementById('content').innerHTML,
                    })
                    .then(response => {
                        this.comment = [this.newCommentContent];
                        this.comments.push(this.comment);

                        this.newCommentContent = '';
                    })
                    .catch(response => {
                        console.log(document.getElementById('content').innerHTML);
                    })
            }
        }
    })
</script>
@endsection