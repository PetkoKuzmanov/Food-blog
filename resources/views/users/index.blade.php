@extends('layouts.app')

@section('title', "Users")

@section('content')
    <p>The users of the website:</p>

    @if (session('message'))
        <p><b>{{ session('message')}}</b></p>
    @endif
    
    <ul>
        @foreach ($users as $user)
            <li><a href="{{ route('users.show', ['user' => $user->id]) }}">{{ $user->name }}</a></li>
        @endforeach
    </ul>
@endsection