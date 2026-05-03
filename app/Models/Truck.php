<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Truck.php
class Truck extends Model {
    protected $fillable = ['matricule', 'marque', 'status'];

    public function deliveries() { return $this->hasMany(Delivery::class); }
    public function maintenances() { return $this->hasMany(Maintenance::class); }
    public function fuels() { return $this->hasMany(Fuel::class); }
}
