@extends('layouts.app')

@section('title', "Create User")

@section('content')
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <p>Name: <input type="text" name="name" 
            value="{{ old('name') }}"></p>
        <p>Email: <input type="text" name="email"
            value="{{ old('email') }}"></p>
        <p>Role: <input type="text" name="role"
            value="{{ old('role') }}"></p>
        <p>Password: <input type="text" name="password"
            value="{{ old('password') }}"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('users.index') }}">Cancel</a>
    </form>
@endsection