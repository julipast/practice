<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store()
    {

        $data = request()->validate([
            'car_number' => 'string',
            'car_type' => 'string',
        ]);
        Car::create($data);
        return redirect()->route('cars.index');
    }

    public function show(Car $car)
    {
    return view('cars.show', compact('car'));

    }
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));

    }

    public function update(Car $car)
    {
        $data = request()->validate([
            'car_number' => 'string',
            'car_type' => 'string',
        ]);
        $car->update($data);
        return redirect()->route('cars.show',$car->id);
    }

    public function delete()
    {
        $car = Car::find(5);
        $car->delete();
        dd('delete');
    }
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index');
    }
    public function firstOrCreate()
    {
        $car = Car::find(1);

        $anotherCar = [
            'car_number' => 'NA-4867',
            'car_type' => 'C',
        ];
        $car = Car::firstOrCreate([
            'car_number' => 'BR-4090'
        ], [
            'car_number' => 'BR-4090',
            'car_type' => 'C',

        ]);
        dump($car->car_number);
        dd('firstOrCreate');
    }

    public function updateOrCreate()
    {

        $anotherCar = [
            'car_number' => 'NA-4867',
            'car_type' => 'C',
        ];
        $car = Car::updateOrCreate([
            'car_number' => 'BG-5678'
        ], [
            'car_number' => 'BG-5678',
            'car_type' => 'C',

        ]);
        dump($car->car_number);
        dd('updateOrCreate');
    }

}


