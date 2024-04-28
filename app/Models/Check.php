<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Check extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='checks';
    protected $guarded = false;


    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }
}
