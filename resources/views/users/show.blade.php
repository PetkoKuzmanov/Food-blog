@extends('layouts.app')

@section('title', "User Details")

@section('content')
    <ul>
        <li>Name: {{ $user->name }}</li>
        <li>Email: {{ $user->email }}</li>
        <li>Role: {{ $user->role }}</li>
    </ul>
@endsection