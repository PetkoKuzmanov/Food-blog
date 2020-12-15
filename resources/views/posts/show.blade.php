@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <ul>
            <h1 class="display-3">{{ $post->title }}</h1>
            <h2 class="display-6">Tags:
                @foreach ($post->tags as $tag)
                <a class="btn btn-outline-primary" href="{{ route('tags.show', ['tag' => $tag->id]) }}">{{ $tag->name }}</a>
                @endforeach
            </h2>
            <h3>Posted by: <a href="{{ route('users.show', ['user' => $post->user->id]) }}">{{ $post->user->name }}</a></h3>

            @foreach ($post->images as $image)
            <img src="{{ asset('/images/'.$image->url) }}" width="200" height="200">
            @endforeach

            <h4 class="text-justify">{{ $post->content }}</h4>
            <br>

            <!-- <ul>
    Ingredients:
        @foreach ($post->ingredients as $ingredient)
        <li>{{ $ingredient->name }} {{ $ingredient->amount }}{{ $ingredient->measurement }}</li>
        @endforeach
    </ul> -->

            <div id="comments">
                <h5>Comments:</h5>
                @if (count($post->comments) > 0)
                <p v-for="comment in comments">
                    @{{ comment.content }}
                    <br>

                    Posted by: <a href="{{ route('users.show' , 3) }}">@{{ comment.user.name }}</a>
                    <br>

                    <!-- <a href="#" @click="editComment">Edit</a>
                    <a href="#" @click="deleteComment">Delete</a> -->

                </p>
                @else
                No comments
                @endif
                <br>
                
                <div class="input-group mb-3">
                    <input class="input-group-text" type="text" id="input" placeholder="Add a comment..." v-model="newCommentContent" aria-describedby="button-addon2">
                    <button class="btn btn-outline-primary" @click="createComment" id="button-addon2">Comment</button>
                </div>
            </div>

            <div id="post_id" hidden>
                {{ $post->id }}
            </div>
            <div id="user_id" hidden>
                {{ Auth::id() }}
            </div>

            @if (Auth::user() && Auth::user()->id == $post->user->id)
            <div class="row justify-content-end">
                <form method="POST" action="{{ route('posts.edit', ['post' => $post->id]) }}">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-primary" type="submit">Edit</button>
                </form>

                <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-primary" type="submit">Delete</button>
                </form>
            </div>
            @endif
    </div>
</div>

<script>
    var app = new Vue({
        el: '#comments',
        data: {
            comments: [],
        },
        mounted() {
            this.getComments()
        },
        methods: {
            createComment: function() {
                axios.post("{{ route ('api.comments.store') }}", {
                        content: this.newCommentContent,
                        post_id: document.getElementById('post_id').innerHTML,
                        user_id: document.getElementById('user_id').innerHTML,
                    })
                    .then(response => {
                        this.comments.push(response.data[0]);
                        this.newCommentContent = '';
                    })
                    .catch(response => {
                        console.log(response);
                    })
            },
            getComments: function() {
                axios.get("{{ route ('api.comments.index') }}?id={{ $post->id }}")
                    .then(response => {
                        this.comments = response.data;
                    })
                    .catch(response => {
                        console.log(response);
                    })
            },
            // deleteComment: function() {
            //     axios.delete("{{ route ('api.comments.destroy') }}", {
            //             post_id: document.getElementById('post_id').innerHTML,
            //             // id: ,
            //         })
            //         .then(response => {
            //             this.comments = [];
            //             this.comments.push(response.data[0]);
            //         })
            //         .catch(response => {
            //             console.log(response);
            //         })
            // }
        }
    })
</script>
@endsection