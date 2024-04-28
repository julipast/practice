@extends('layouts.header')
@section('content')
    @php
        $start= \Illuminate\Support\Facades\Session::get('reservation')['start_date'];
        $end= \Illuminate\Support\Facades\Session::get('reservation')['end_date'];
        $id= \Illuminate\Support\Facades\Session::get('reservation')['parking_id'];
        $total_cost= \Illuminate\Support\Facades\Session::get('reservation')['total_cost'];
    @endphp
    <div class="reserve-row">
        <h1 class="text-reserv">Підтвердіть бронювання</h1>
        <div class="details">
            <h2 class="text-reserv">Деталі бронювання</h2>
            <div class="accept-reserve">
                <div id='reserve-about-info' class="col-lg-6 col-md-6 col-sm-12">
                    <div class="reservation-info">Початок бронювання {{$start}}</div>
                    <div class="reservation-info">Кінець {{ $end }}</div>
                    <div class="reservation-info">До сплати {{ $total_cost }}</div>
                </div>
                <div id='reserve-about-info' class="col-lg-6 col-md-4 col-sm-12">
                    <div class="reservation-info">
                        <i class="fa-solid fa-location-dot"></i>
                        {{ $parking->address }}

                    </div>
                    <div class="number reservation-info">
                        <i class="fa-solid fa-car"> </i>
                        {{ $parking->count }}

                    </div>
                    <div class="number reservation-info">
                        <i class="fa-solid fa-hryvnia-sign"></i>
                        {{ $parking->price }}
                    </div>
                </div>
                <form  class=" col-lg-4 col-md-6 col-sm-12" action="{{route('reservation.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="parking_id"
                           value="{{ (\Illuminate\Support\Facades\Session::get('reservation')['parking_id']) }}">

                    <select id="select-car" class="form-select" aria-label="Default select example" name="car_id">
                        <option selected>Вибрати автомобіль</option>
                        @foreach(auth()->user()->cars as $car)
                            <option value="{{$car->id}}">{{$car->car_number}}</option>
                        @endforeach
                    </select>

                    <input type="hidden" name="total_cost" class="form-control" id="total_cost"
                           value="{{ (\Illuminate\Support\Facades\Session::get('reservation')['total_cost'])}}">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="number_park"
                           value="{{ (\Illuminate\Support\Facades\Session::get('reservation')['number_park'])}}">
                    <input type="hidden" name="start_date" class="form-control" id="start_date"
                           value="{{ (\Illuminate\Support\Facades\Session::get('reservation')['start_date'])}}">
                    <input type="hidden" name="end_date" class="form-control" id="end_date"
                           value="{{ (\Illuminate\Support\Facades\Session::get('reservation')['end_date'])}}">

                    <div class="mt-4">
                        <button id='status-accept' type="submit" class="btn btn-primary">Підтвердити</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
    </div>
@endsection

