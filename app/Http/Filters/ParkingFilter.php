<?php

namespace App\Http\Filters;

use App\Models\Parking;
use Illuminate\Database\Eloquent\Builder;

class ParkingFilter extends AbstractFilter
{
public const ADMIN_ID ='admin_id';
public const COUNT ='count';
public const PRICE ='price';
public const ADDRESS ='address';
public const MARK ='mark' ;
public const STATUS ='status';
public const START_DATE ='start_date';
public const END_DATE ='end_date';

    protected function getCallbacks(): array
    {
        return [
            self::ADMIN_ID=>[$this, 'admin_id'],
            self::COUNT=>[$this, 'count'],
            self::PRICE=>[$this, 'price'],
            self::ADDRESS=>[$this, 'address'],
            self::MARK=>[$this, 'mark'],
            self::STATUS=>[$this, 'status'],
//            self::START_DATE=>[$this, 'start_date'],
//            self::END_DATE=>[$this, 'end_date'],

        ];
    }
//    public function start_date(Builder $builder, $value)
//    {
//      $builder->with('reservations')->whereHas('reservations', function($query) use ($value) {
//           $query->whereDate('start_date','like',  $value);
//        });
//    }
//    public function end_date(Builder $builder, $value)
//    {
//        $builder->with('reservations')->whereHas('reservations', function($query) use ($value) {
//            $query->whereDate('end_date','like',  $value);
//        });
//    }
    public function admin_id(Builder $builder, $value)
    {
        $builder->where('admin_id', 'like', "%{$value}%");
    }
    public function count(Builder $builder, $value)
    {
        $builder->where('count', 'like', "%{$value}%");
    }
    public function price(Builder $builder, $value)
    {
        $builder->where('price', 'like', "%{$value}%");
    }
    public function address(Builder $builder, $value)
    {
        if ($value !== null) {
            $builder->where('address', 'like', "%{$value}%");
        }
    }
    public function mark(Builder $builder, $value)
    {
        $builder->where('mark', 'like', "%{$value}%");
    }
    public function status(Builder $builder, $value)
    {
        $builder->where('status', 'like', "%{$value}%");
    }
}
