@extends('layouts.header')
@section('content')

    <div class="promo-row">
        <div class="search-row">
            <div class="container col-lg-6 col-md-6 col-sm-12">
                <div class="block">
                    <form class="position-relative" action="javascript:void(0);">
                        <input type="text" class="form-control" id="search-input"
                               value='{{isset($address)?$address:''}}' placeholder="Введіть адресу">
                        <ul id="search-results"></ul>
                    </form>
                </div>
            </div>
            <div class="container col-lg-6 col-md-6 col-sm-12">
                <input type="text" name="daterange" id="daterange" value='' placeholder="Введіть дату">
            </div>
        </div>

        <div class="park-row">

            @foreach($parkings as $parking)

                <div class="park-item col-lg-6 col-md-6 col-sm-12"><a class="name-park"
                                                                      href="{{route('parking.show', $parking->id)}}">{{$parking->id}}
                        .{{$parking->address}}</a>
                        <form action="{{route('reservation.add')}}" method="POST">
                        @csrf
                        <input type="text" name="parking_id" value="{{$parking->id}}" hidden>
                        <input type="text" name="user_id" value="{{auth()->user()->id}}" hidden >
                        <input type="text" name="number_park" value="{{$parking->number_park}}" hidden>
                        <input type="text" name="price" value="{{$parking->price}}" hidden>
                        <input type="text" name="start_date" value="{{$start_date}}" hidden>
                        <input type="text" name="end_date" value="{{$end_date}}" hidden>
                            @if($start_date == $end_date)
                                <button type="button" class="reserve-button btn btn-success" disabled>Резерв</button>
                            @else
                                <button type="submit" class="reserve-button btn btn-success">Резерв</button>
                            @endif
                        <div class="count">{{$parking->available_place}}</div>

                    </form>

                </div>
            @endforeach
        </div>
        <div>
            {{$parkings->withQueryString()->links()}}
        </div>
    </div>
    </div>
@endsection
@push('calendarVariable')
    <script>
        var start = '{{$start_date}}';
        var end = '{{$end_date}}';

    </script>
@endpush
