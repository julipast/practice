<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use App\Models\Parking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $reservations = $user->reservations()->get();
        return view('reservation.index', compact('reservations'));
    }
    public function adminindex()
    {
        $user = Auth::user();
        $reservations = $user->reservations()->get();
        return view('admin.reservations.index', compact('reservations'));
    }
    public function reservationAdd(Request $request){
      // dd($request->all());
      //  dd(auth()->user()->cars);
        $parking=Parking::find($request->parking_id);
        $reservationId = session('reservationId');
        if (!$reservationId) {
            $reservation = new Reservation([
                'parking_id' => $request->parking_id,
                'user_id' => auth()->user()->id,
                'number_park' => $request->number_park,
                'start_date' => \Carbon\Carbon::createFromFormat('d/m/Y H:i', $request->start_date)->format('Y-m-d H:i:s'),
                'end_date' => \Carbon\Carbon::createFromFormat('d/m/Y H:i', $request->end_date)->format('Y-m-d H:i:s'),
            ]);
            session(['reservation' => $reservation->toArray()]);
        } else {
            $reservation = new Reservation(session('reservation'));
        }
        $startDate = \Carbon\Carbon::createFromFormat('d/m/Y H:i',$request->start_date);
        $endDate = \Carbon\Carbon::createFromFormat('d/m/Y H:i',$request->end_date);
        $duration = $endDate->diffInMinutes($startDate);
        $duration = ($duration === 0) ? 1 : $duration;
        $totalCost = round(($request->price / 60) * $duration);
        $reservation['total_cost'] = $totalCost;
        session(['reservation' => $reservation->toArray()]);
        return view('reservation.add', compact('parking'));
    }
    public function create()
    {

        return view('reservation.create');
    }

    public function store()
    {
        $data = request()->validate([
            'parking_id' => '',
            'car_id' => '',
            'user_id' => '',
            'number_park' => 'numeric',
            'total_cost' => 'numeric',
            'mark' => 'nullable|numeric',
            'start_date' => 'date',
            'end_date' => 'date',
            'status' => 'boolean',
        ]);
        Reservation::create($data);
        return redirect()->route('reservation.index');
    }

    public function show(Reservation $reservation)
    {
    return view('reservation.show', compact('reservation'));

    }
    public function edit(Reservation $reservation)
    {
        return view('reservation.edit', compact('reservation'));

    }

    public function update(Reservation $reservation)
    {
        $data = request()->validate([
            'total_cost' => 'numeric',
            'mark' => 'numeric',
            'start_date' => 'date',
            'end_date' => 'date',
            'status' => 'boolean',
        ]);
        $reservation->update($data);
        return redirect()->route('reservation.show',$reservation->id);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservation.index');
    }

}


