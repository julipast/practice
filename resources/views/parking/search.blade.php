@extends('layouts.header')
@section('content')

    <h1>Search Results</h1>
    <ul>
        @foreach ($parkings as $parking)
            <li>{{ $parking->count }}, {{ $parking->price }}, {{ $parking->address }}</li>
        @endforeach
    </ul>
@endsection
