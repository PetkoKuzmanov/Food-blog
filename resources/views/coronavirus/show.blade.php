@extends('layouts.app')

@section('title', "COVID-19 Information for the United Kingdom")

@section('content')
<div>
    <h1>Cases for {{$dailyCases['date']}}: <b>{{$dailyCases['dateData']}}</b></h1>
    <br>

    <h1>Deaths for the week of {{$weeklyDeaths['date']}}: <b>{{$weeklyDeaths['dateData']}}</b></h1>

</div>
@endsection