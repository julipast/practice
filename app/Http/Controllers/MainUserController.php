<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class MainUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.profile.index', compact('users'));
    }

}


