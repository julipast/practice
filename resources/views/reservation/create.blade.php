@extends('layouts.header')
@section('content')
    <div class="reserve-create">
    <form action="{{route('reservation.store')}}" method="post">
        @csrf
        <input type="hidden" name="parking_id" value="{{$parking->id}}">
        <input type="hidden" name="car_id" value="{{ 1 }}">
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <div class="mb-3">
            <label for="number_park">Number park</label>
            <input type="text" name="number_park" class="form-control" id="number_park">
        </div>
        <div class="mb-3">
            <label for="total_cost">Total cost</label>
            <input type="text" name="total_cost" class="form-control" id="total_cost">
        </div>
        <div class="mb-3">
            <label for="mark">Mark</label>
            <input type="text" name="mark" class="form-control" id="mark">
        </div>
        <div class="mb-3">
            <label for="start_date">Start date</label>
            <input type="date" name="start_date" class="form-control" id="start_date">
        </div>
        <div class="mb-3">
            <label for="end_date">End date</label>
            <input type="date" name="end_date" class="form-control" id="end_date">
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
    </div>
@endsection

