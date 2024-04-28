<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='reservations';
    protected $guarded = false;

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function parking()
    {
        return $this->belongsTo(Parking::class, 'parking_id');
    }
    public function check()
    {
        return $this->hasOne(Check::class,'reservation_id','id');
    }
}
