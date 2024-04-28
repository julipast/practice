@extends('layouts.header')
@section('content')
    <div class="col-5">
    <div>{{$parking->id}}.{{$parking->address}}</div>
    <div><a href="{{route('reservation.create', $parking->id)}}">Reserve</a></div>
    <div><a href="{{route('parking.index')}}">Back</a></div></div>
@endsection

