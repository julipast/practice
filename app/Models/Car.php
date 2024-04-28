<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='cars';
    protected $guarded = false;

    public function reservations()
    {
        return $this->hasMany(Reservation::class,'car_id','id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_cars','car_id','user_id');
    }
}
