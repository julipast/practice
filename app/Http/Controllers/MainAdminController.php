<?php

namespace App\Http\Controllers;

class MainAdminController extends Controller
{
   public function index()
   {
       return view('admin.main.index');
   }
}
