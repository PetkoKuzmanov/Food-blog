@extends('layouts.app')

@section('title', "Update your profile")

@section('content')
@if (Auth::user() && Auth::user()->id == $user->id)
<form method="POST" action="{{ route('users.update', ['user' => $user]) }}" enctype="multipart/form-data" action="/details">
    @csrf
    @method('PUT')

    <h1>Name: <input class="input-group-text" type="text" name="name" value="{{ $user->name }}"></h1>
    <br>

    <h1>Profile picture:</h1>
    @if ($user->profilePicture()->exists())
    <img alt="Profile picture" src="{{ asset('/profilePictures/'.$user->profilePicture->url) }}" width="200" height="200">
    @else
    <img alt="Default profile picture" src="{{ asset('/profilePictures/defaultProfilePicture.jpg') }}" width="200" height="200">
    @endif

    <div class="input-group mb-3">
        <input type="file" name="profilePicture" class="form-control" aria-describedby="inputGroupFileAddon03">
    </div>

    <input type="submit" value="Submit" class="btn btn-success">
    <a class="btn btn-danger" href="{{ route('users.show', ['user' => $user->id]) }}">Cancel</a>
</form>
@endif
@endsection