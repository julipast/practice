@extends('layouts.header')
@section('content')
   <div>
       <div>
           <a href="{{route('cars.create')}}" class="btn btn-primary">Add car</a>
       </div>
       @foreach($cars as $car)
           <div><a href="{{route('cars.show', $car->id)}}">{{$car->id}}.{{$car->car_number}}</a></div>
       @endforeach
   </div>
@endsection

