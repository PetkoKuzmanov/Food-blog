@extends('layouts.app')

@section('title', "Update your profile")

@section('content')
@if (Auth::user() && Auth::user()->id == $user->id)
<form method="POST" action="{{ route('users.update', ['user' => $user]) }}" enctype="multipart/form-data" action="/details">
    @csrf
    @method('PUT')
    @if ($user->profilePicture()->exists())
    <img src="{{ asset('/profilePictures/'.$user->profilePicture->url) }}" width="200" height="200">
    @else
    <img src="{{ asset('/profilePictures/defaultProfilePicture.jpg') }}" width="200" height="200">
    @endif

    <div class="input-group mb-3">
        <input type="file" name="profilePicture" class="form-control" aria-describedby="inputGroupFileAddon03">
        <label class="input-group-text" for="profilePicture">Upload</label>
    </div>

    <p>Name: <input type="text" name="name" value="{{ $user->name }}"></p>

    <input type="submit" value="Submit" class="btn btn-primary">
</form>
@endif
@endsection