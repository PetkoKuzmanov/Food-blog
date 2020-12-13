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
        <img src="{{ asset('/images/'.$image->url) }}" width="200" height="200">
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
                <li v-for="comment in comments">@{{ comment.content }} <br> Posted by: <a href="{{ route('users.show', 6  ) }}">@{{ comment.user_id }}</a></li>
            </ul>
            @else
            No comments
            @endif
        </li>

        <br>
        <input type="text" id="input" placeholder="Add a comment..." v-model="newCommentContent">
        <button @click="createComment">Comment</button>
    </div>
    <div id="post_id" hidden>
        {{ $post->id }}
    </div>
    <div id="user_id" hidden>
        {{ Auth::id() }}
    </div>

    <form method="POST" action="{{ route('posts.edit', ['post' => $post->id]) }}">
        @csrf
        @method('PUT')
        <button class="btn-default" type="submit">EDIT</button>
    </form>

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
            // post_id = document.getElementById('content').innerHTML
        },
        mounted() {
            axios.get("{{ route ('api.comments.index') }}")
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
                        post_id: document.getElementById('post_id').innerHTML,
                        user_id: document.getElementById('user_id').innerHTML,
                    })
                    .then(response => {
                        this.comments.push(response.data);

                        this.newCommentContent = '';
                    })
                    .catch(response => {
                        console.log(response);
                    })
            }
        }
    })
</script>
@endsection