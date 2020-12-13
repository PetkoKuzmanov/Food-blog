@extends('layouts.app')

@section('title', "User Details")

@section('content')
@if (Auth::user() && Auth::user()->id == $user->id)
<form method="POST" action="{{ route('users.edit') }}" enctype="multipart/form-data" action="/details">
    @csrf
    @method('PUT')
    
    <div class="input-group mb-3">
        <input type="file" name="profilePicture" class="form-control" aria-describedby="inputGroupFileAddon03" multiple>
        <label class="input-group-text" for="profilePicture">Upload</label>
    </div>
    <p>Name: <input type="text" name="name" value="{{ $user->name }}"></p>

    <input type="submit" value="Submit picture" class="btn btn-primary">
</form>
@endif
@endsection