@extends('layouts.header')
@section('content')
    <div>{{$car->id}}.{{$car->car_number}}</div>
    <div><a href="{{route('cars.edit', $car->id)}}">Edit</a></div>
    <div>
        <form action="{{route('cars.delete', $car->id)}}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>
    <div><a href="{{route('cars.index')}}">Back</a></div>
@endsection

