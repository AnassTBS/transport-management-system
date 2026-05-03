<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    protected $fillable = [
        'truck_id', 'quantity', 'cost',
        'price_per_litre', 'date', 'station'
    ];

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }
}
