<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Driver.php
class Driver extends Model {
    protected $fillable = ['nom', 'tel', 'permis'];
    public function deliveries() { return $this->hasMany(Delivery::class); }
}
