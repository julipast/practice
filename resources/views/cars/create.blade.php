@extends('layouts.header')
@section('content')
    <form action="{{route('cars.store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="car_number">Car number</label>
            <input type="text" name="car_number" class="form-control" id="car_number">
        </div>
        <div class="mb-3">
            <label for="car_type">Car type</label>
            <input type="text" name="car_type" class="form-control" id="car_type">
        </div>
        <select class="form-select" aria-label="Default select example" name="qw">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection

