@extends('layouts.app')

@section('title', "Tags")

@section('content')
    @if (session('message'))
        <p><b>{{ session('message')}}</b></p>
    @endif
    
    <ul>
        @foreach ($tags as $tag)
            <a class="btn btn-outline-primary" href="{{ route('tags.show', ['tag' => $tag->id]) }}">{{ $tag->name }}</a>
            <br>
        @endforeach
    </ul>
@endsection