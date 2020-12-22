@extends('layouts.app')

@section('title', "Tags")

@section('content')
<div>
    @if (session('message'))
    <p><b>{{ session('message')}}</b></p>
    @endif

    @foreach ($tags as $tag)
    <p><a class="btn btn-outline-primary" href="{{ route('tags.show', ['tag' => $tag->id]) }}">{{ $tag->name }}</a></p>
    @endforeach
    <br>
    
    {{ $tags->links() }}
</div>
@endsection