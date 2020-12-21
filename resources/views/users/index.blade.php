@extends('layouts.app')

@section('title', "Chefs")

@section('content')
<div>
    @if (session('message'))
    <p><b>{{ session('message')}}</b></p>
    @endif

    @foreach ($users as $user)
    <p><a class="btn btn-outline-primary" href="{{ route('users.show', ['user' => $user->id]) }}">{{ $user->name }}</a></p>
    @endforeach
    
</div>
@endsection