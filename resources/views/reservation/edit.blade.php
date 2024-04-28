@extends('layouts.main')
@section('content')
    <form action="{{route('reservation.update', $reservation->id)}}" method="post">
        @csrf
        @method('patch')
        <div class="mb-3">
            <label for="total_cost">Total_cost</label>
            <input type="text" name="total_cost" class="form-control" id="total_cost" value="{{$reservation->total_cost}}">
        </div>
        <div class="mb-3">
            <label for="mark">Mark</label>
            <input type="text" name="mark" class="form-control" id="mark"  value="{{$reservation->mark}}">
        </div>
        <div class="mb-3">
            <label for="start_date">Start date</label>
            <input type="text" name="start_date" class="form-control" id="start_date"  value="{{$reservation->start_date}}">
        </div>
        <div class="mb-3">
            <label for="end_date">End date</label>
            <input type="text" name="end_date" class="form-control" id="end_date"  value="{{$reservation->end_date}}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

