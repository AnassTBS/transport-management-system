<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = [
        'truck_id', 'type', 'date', 'cost', 'description'
    ];

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }
}

