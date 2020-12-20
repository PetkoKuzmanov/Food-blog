@extends('layouts.app')

@section('title', "Update your profile")

@section('content')
@if (Auth::user() && Auth::user()->id == $user->id)
<form method="POST" action="{{ route('users.update', ['user' => $user]) }}" enctype="multipart/form-data" action="/details">
    @csrf
    @method('PUT')

    <label class="h1">Name:</label>
    <div class="input-group">
        <textarea type="text" name="name" class="form-control" aria-describedby="title-textarea">{{ $user->name }}</textarea>
    </div>

    <h1>Profile picture:</h1>
    @if ($user->image()->exists())
    <img alt="Profile picture" src="{{ asset('/profilePictures/'.$user->image->url) }}" width="200" height="200">
    @else
    <img alt="Default profile picture" src="{{ asset('/profilePictures/defaultProfilePicture.jpg') }}" width="200" height="200">
    @endif

    <div class="custom-file mb-3">
        <input type="file" class="custom-file-input" id="inputGroupFile01" name="image" multiple aria-describedby="images-input">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
    </div>

    <input type="submit" value="Submit" class="btn btn-success">
    <a class="btn btn-danger" href="{{ route('users.show', ['user' => $user->id]) }}">Cancel</a>
</form>
@endif
@endsection