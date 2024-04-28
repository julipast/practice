<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\MainUserController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MyPlaceController;
use App\Http\Controllers\ParkingsController;
use App\Http\Controllers\ReservationsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\SuperAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route:: middleware(['auth', 'user'])->group(function () {

    Route::get('/', function () {
        return redirect()->route('parking.index');
    });
    Route::get('/cars', [CarsController::class, 'index'])->name('cars.index');
    Route::get('/cars/create', [CarsController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarsController::class, 'store'])->name('cars.store');
    Route::get('/cars/{car}', [CarsController::class, 'show'])->name('cars.show');
    Route::get('/cars/{car}/edit', [CarsController::class, 'edit'])->name('cars.edit');
    Route::patch('/cars/{car}', [CarsController::class, 'update'])->name('cars.update');
    Route::delete('/cars/{car}', [CarsController::class, 'destroy'])->name('cars.delete');

    Route::get('/reservations', [ReservationsController::class, 'index'])->name('reservation.index');
    Route::get('/reservations/create', [ReservationsController::class, 'create'])->name('reservation.create');
    Route::post('/reservations', [ReservationsController::class, 'store'])->name('reservation.store');
    Route::get('/reservations/{reservation}', [ReservationsController::class, 'show'])->name('reservation.show');
    Route::get('/reservations/{reservation}/edit', [ReservationsController::class, 'edit'])->name('reservation.edit');
    Route::patch('/reservations/{reservation}', [ReservationsController::class, 'update'])->name('reservation.update');
    Route::delete('/reservations/{reservation}', [ReservationsController::class, 'destroy'])->name('reservation.delete');
    Route::post('/reservation/add', [ReservationsController::class, 'reservationAdd'])->name('reservation.add');

    Route::get('/parkings', [ParkingsController::class, 'index'])->name('parking.index');
    Route::get('/main/parkings', [ParkingsController::class, 'index'])->name('main.parking.index');
    Route::get('/parkings/{parking}', [ParkingsController::class, 'show'])->name('parking.show');

    Route::get('/main', [MainUserController::class, 'index'])->name('main.index');
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    Route::get('/search', [ParkingsController::class, 'search'])->name('search');

    Route::get('/profile', [MainUserController::class, 'index'])->name('user.profile.index');
    Route::get('/map', [MapController::class, 'index'])->name('user.map.index');


});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route:: middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin.index');;
    Route::get('/', function () {
        return redirect()->route('superadmin.index');
    });
    Route::get('/superadmin/users', [SuperAdminController::class, 'index'])->name('superadmin.users.index');
    Route::get('/superadmin/users/create', [SuperAdminController::class, 'create'])->name('superadmin.users.create');
    Route::post('/superadmin/users', [SuperAdminController::class, 'store'])->name('superadmin.users.store');
    Route::get('/superadmin/search', [SuperAdminController::class, 'search'])->name('superadmin.users.search');
});


Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [MainAdminController::class, 'index'])->name('admin.index');;
    Route::get('/', function () {
        return redirect()->route('admin.index');
    });
    Route::get('/admin/parkings', [ParkingsController::class, 'index_admin'])->name('admin.parking.index');
    Route::get('/admin/parking/create', [ParkingsController::class, 'create'])->name('parking.create');
    Route::post('/admin/parkings', [ParkingsController::class, 'store_admin'])->name('admin.parking.store');
    Route::get('/admin/search', [ParkingsController::class, 'adminsearch'])->name('admin.parking.search');
    Route::get('/admin/reservations', [ReservationsController::class, 'adminindex'])->name('admin.reservations.index');
    Route::get('/admin/reservations/create', [ReservationsController::class, 'create'])->name('reservations.create');


});


