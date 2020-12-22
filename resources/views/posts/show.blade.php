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
            <img alt="Post image" src="{{ asset('/images/'.$image->url) }}" width="200" height="200">
            @endforeach
            <br>
            <br>

            @if ($post->nutritionalInfo()->exists())
            <h4 class="text-justify">Serving size: {{ $post->nutritionalInfo->servingSize }} </h4>
            <h4 class="text-justify">Calories: {{ $post->nutritionalInfo->calories }}</h4>
            @endif
            <br>
            
            <h4 class="text-justify">{{ $post->content }}</h4>
            <br>

            <div id="comments">
                <h5>Comments:</h5>
                @if (count($post->comments) > 0)
                <template v-for="comment in comments">
                    <tempalte v-if="editedComment != comment.id">@{{ comment.content }}</tempalte>

                    <tempalte v-if="editedComment == comment.id">
                        <input class="form-control" type="text" id="input" v-model="commentContent" aria-describedby="button-addon2">
                        <button class="btn btn-outline-success" @click="updateComment(comment.id)" id="button-addon2">OK</button>
                        <button class="btn btn-outline-danger" @click="cancelEditComment()" id="button-addon2">Cancel</button>
                    </tempalte>
                    <br>

                    Posted by: <a href="#" @click="showUser(comment.user.id)">@{{ comment.user.name }}</a>
                    <br>

                    <template v-if="comment.user_id == {{Auth::user()->id}}">
                        <button class="btn btn-outline-primary" type="submit" @click="editComment(comment.id, comment.content)">Edit</button>
                        <button class="btn btn-outline-danger" type="submit" @click="deleteComment(comment.id)">Delete</button>
                        <br>
                    </template>
                    <br>
                </template>
                @else
                No comments
                @endif
                <br>

                <div class="input-group mb-3">
                    <input class="form-control" type="text" id="input" placeholder="Add a comment..." v-model="newCommentContent" aria-describedby="button-addon2">
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
                    <button class="btn btn-danger" type="submit">Delete</button>
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
            commentContent: "",
            editedComment: -1,
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
            deleteComment: function(comment_id) {
                axios.delete("{{ route ('api.comments.destroy') }}", {
                        data: {
                            post_id: document.getElementById('post_id').innerHTML,
                            id: comment_id,
                        }
                    })
                    .then(response => {
                        this.comments = response.data;
                    })
                    .catch(response => {
                        console.log(response);
                    })
            },
            editComment: function(comment_id, commentContent) {
                this.editedComment = comment_id,
                    this.commentContent = commentContent
            },
            cancelEditComment: function() {
                this.editedComment = -1,
                    this.commentContent = ""
            },
            updateComment: function(comment_id) {
                axios.put("{{ route ('api.comments.update') }}", {
                        content: this.commentContent,
                        id: comment_id,
                        post_id: document.getElementById('post_id').innerHTML,
                    })
                    .then(response => {
                            this.comments = response.data;
                        },
                        this.cancelEditComment(),
                    )
                    .catch(response => {
                        console.log(response);
                    })
            },
            showUser: function(user_id) {
                window.location.href = "http://coursework.test/home/users/" + user_id;
            }
        }
    })
</script>
@endsection