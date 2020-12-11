@extends('layouts.app')

@section('title', "Tags")

@section('content')
    <p>The tags of the website:</p>

    @if (session('message'))
        <p><b>{{ session('message')}}</b></p>
    @endif
    
    <ul>
        @foreach ($tags as $tag)
            <li><a href="{{ route('tags.show', ['tag' => $tag->id]) }}">{{ $tag->name }}</a></li>
        @endforeach
    </ul>
@endsection