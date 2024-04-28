<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('superadmin.users.index', compact('users'));
    }

    public function create()
    {
        return view('superadmin.users.create');
    }

    public function store()
    {

        $data = request()->validate([
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'email',
            'password' => 'required',
            'role' => 'string'
        ]);
        User::create($data);
        return redirect()->route('superadmin.users.index');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $users = User::where(function ($query) use ($search) {
            $query->where('id', 'like', "%$search%")
                ->orWhere('first_name', 'like', "%$search%")
                ->orWhere('last_name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        })
            ->get();
        return view('superadmin.users.index', compact('users', 'search'));
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
        return redirect()->route('cars.show', $car->id);
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index');
    }
}
