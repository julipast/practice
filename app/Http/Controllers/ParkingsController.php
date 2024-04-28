<?php

namespace App\Http\Controllers;

use App\Http\Filters\ParkingFilter;
use App\Http\Requests\Parking\FilterRequest;
use App\Models\Parking;
use Carbon\Carbon;
use Illuminate\Http\Request;
class ParkingsController extends Controller
{
    public function index_admin()
    {   $parkings = Parking::all();
        return view('admin.parkings.index', compact('parkings'));
    }

    public function index(FilterRequest $request)
    {
        $data=$request->validated();
        $filter=app()->make(ParkingFilter::class, ['queryParams'=>array_filter($data)]);
        $address=$request->input('address');
        $parkings=Parking::filter($filter)->get();
        $parkingsforpagination=Parking::filter($filter)->paginate(6);
        $start_date = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now('Europe/Kyiv');
        $end_date = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now('Europe/Kyiv');
        $parkingsWithUniqueNumbers = [];
      // dd($request->input('start_date'));
        foreach ($parkings as $parking){
            $reservations = $parking->reservations()
                ->where(function($query) use ($start_date, $end_date, $parking) {
                    $query->where('start_date', '<=', $start_date)
                        ->where('end_date', '>=', $end_date)
                        ->where('parking_id', $parking->id);
                })
                ->orWhere(function($query) use ($start_date, $end_date, $parking) {
                    $query->where('start_date', '>=', $start_date)
                        ->where('end_date', '<=', $end_date)
                        ->where('parking_id', $parking->id);
                })
                ->orWhere(function($query) use ($start_date, $end_date, $parking) {
                    $query->where('start_date', '<=', $start_date)
                        ->where('end_date', '>', $start_date)
                        ->where('parking_id', $parking->id);
                })
                ->orWhere(function($query) use ($start_date, $end_date, $parking) {
                    $query->where('start_date', '<', $end_date)
                        ->where('end_date', '>=', $end_date)
                        ->where('parking_id', $parking->id);
                })


                        ->pluck('number_park')
                        ->map(function ($item) {
                            return (int) $item;
                        })
                        ->toArray();

        $num = range(1, $parking->count);

        if (!empty($reservations)) {
            $mergedArray = array_merge($reservations, $num);
            $counts = array_count_values($mergedArray);
            $nunic = array_keys(array_filter($counts, function ($count) {
                return $count === 1;
            }));
        }
        else  $nunic = $num;
//        dd($parking->count, $parking->id,$reservations );
            if (count($nunic) > 0) {
                $parkingsWithUniqueNumbers[] = [
                    'parking_id' => $parking->id,
                    'number_park' => $nunic[0],
                    'available_place' => count($nunic)
                ];
            }

        }
        foreach( $parkingsforpagination as $parking){
           foreach ($parkingsWithUniqueNumbers as $item){
               if($parking->id==$item['parking_id' ]){
                   $parking['number_park']=$item['number_park'];
                   $parking['available_place']=$item['available_place'];
               }
           }

        }

        $parkings= $parkingsforpagination;

        $start_date = $start_date->format('d/m/Y H:i');

        $end_date = $end_date->format('d/m/Y H:i');

        return view('parking.index', compact('parkings','address', 'start_date', 'end_date'));
    }

    public function create()
    {
        return view('admin.parkings.create');
    }

    public function store_admin()
    {
        $data = request()->validate([
            'admin_id' => '',
            'count' => 'numeric',
            'price' => 'numeric',
            'address' => 'string',
            'mark' => 'nullable|numeric',
            'status' => 'boolean',

        ]);
        Parking::firstOrCreate(['address' => $data['address']], $data);
        return redirect()->route('admin.parking.index');
    }
    public function store()
    {
        $data = request()->validate([
            'count' => 'numeric',
            'price' => 'numeric',
            'address' => 'string',
            'mark' => 'nullable|numeric',
            'status' => 'boolean',

        ]);
        Parking::create($data);
        return redirect()->route('parking.index');
    }
    public function search(Request $request)
    {
        $address = $request->input('address');
        $parkings = Parking::where('address', 'LIKE', "%$address%")->get();
        return response()->json($parkings);
    }
    public function adminsearch(Request $request)
    {
        $search = $request->input('search');
        $parkings = Parking::where(function ($query) use ($search) {
            $query->where('id', 'like', "%$search%")
                ->orWhere('address', 'like', "%$search%")
                ->orWhere('count', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%");
        })
            ->get();
        return view('admin.parkings.index', compact('parkings', 'search'));
    }
    public function show(Parking $parking)
    {
    return view('parking.show', compact('parking'));

    }
    public function show_admin(Parking $parking)
    {
        return view('admin.parkings.show', compact('parking'));

    }
    public function edit(Parking $parking)
    {
        return view('parking.edit', compact('parking'));

    }

    public function update(Parking $parking)
    {
        $data = request()->validate([
            'count' => 'numeric',
            'price' => 'numeric',
            'address' => 'string',
            'mark' => 'nullable|numeric',
            'status' => 'boolean',
        ]);
        $parking->update($data);
        return redirect()->route('parking.show',$parking->id);
    }




    public function destroy(Parking $parking)
    {
        $parking->delete();
        return redirect()->route('parking.index');
    }

}


