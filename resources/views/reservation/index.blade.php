@extends('layouts.header')
@section('content')
  <div id='custom-row' class="promo-row">
      <div class="col-lg-12 col-md-12 col-sm-12 my-text-reserv ">Мої бронювання</div>
   <div class="my-reserve-row">

       @foreach($reservations as $reservation)
           @php
               $start = \Carbon\Carbon::parse($reservation->start_date);
               $end = \Carbon\Carbon::parse($reservation->end_date);
               $diff = $end->diff($start);
               $status=$reservation->status;
               $mystatus='';
               if($status==0){
                   $mystatus='Очікується';
               }
               if($status==1){
                   $mystatus='Активно';
               }
               if($status==2){
                   $mystatus='Завершено';
               }
               $duration = '';
               if ($diff->d > 0) {
                   $duration .= $diff->d . ' день ';
               }
               if ($diff->h > 0) {
                   $duration .= $diff->h . ' год ';
               }
               if ($diff->i > 0) {
                   $duration .= $diff->i . ' хв';
               }

           @endphp



           <div class="my-reserve-item col-lg-6 col-md-6 col-sm-12">
               <div class="reservation-info">Початок бронювання {{ $reservation->start_date }}</div>
               <div class="number reservation-info">
                   <div class="reservation-info">Тривалість   {{ $duration }}</div>
                   <div class="reservation-info">№ {{ $reservation->id }}</div>
               </div>



                       <div id='reserve-about-parking'class="park-item col-lg-6 col-md-6 col-sm-12">
                           <div class="reservation-info">
                               <i class="fa-solid fa-location-dot"></i>
                               {{ $reservation->parking->address }}

                           </div>
                           <div class="number reservation-info">
                               <i class="fa-solid fa-car"> </i>
                                   {{ $reservation->parking->count }}

                           </div>
                           <div class="number reservation-info">
                               <i class="fa-solid fa-hryvnia-sign"></i>
                               {{ $reservation->parking->price }}

                           </div>

                       </div>
               <div class="reservation-info">До сплати   {{ $reservation->total_cost }}</div>
               <div id='status' class="reservation-info">Cтатус: {{ $mystatus }}</div>


           </div>
       @endforeach

   </div>
  </div>
@endsection

