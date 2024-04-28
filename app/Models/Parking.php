<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parking extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;
    protected $table='parkings';
    protected $guarded = false;

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class,'parking_id','id');
    }
}
