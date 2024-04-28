@extends('layouts.main')
@section('content')
    <div>{{$reservation->id}}.{{$reservation->total_cost}}</div>
    <div><a href="{{route('reservation.edit', $reservation->id)}}">Edit</a></div>
    <div>
        <form action="{{route('reservation.delete', $reservation->id)}}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>
    <div><a href="{{route('reservation.index')}}">Back</a></div>
@endsection

