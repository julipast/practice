<?php

namespace App\Http\Controllers;

use App\Models\Parking;

class MapController extends Controller
{
   public function index()
   {
       $parkings=Parking::all();
       return view('user.map.index', compact('parkings'));
   }
}
