@extends('layouts.header')
@section('content')
    <form action="{{route('cars.update', $car->id)}}" method="post">
        @csrf
        @method('patch')
        <div class="mb-3">
            <label for="car_number">Car number</label>
            <input type="text" name="car_number" class="form-control" id="car_number" value="{{$car->car_number}}">
        </div>
        <div class="mb-3">
            <label for="car_type">Car type</label>
            <input type="text" name="car_type" class="form-control" id="car_type"  value="{{$car->car_type}}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

