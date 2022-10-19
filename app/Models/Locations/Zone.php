<?php

namespace App\Models\Locations;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    public function regions()
    {
        return $this->hasMany(Region::class, 'zone_id');
    }

    public function parentLocation()
    {
        return $this->belongsTo(Zone::class, 'location_id');
    }

    public function subLocation()
    {
        return $this->hasMany(Zone::class, 'location_id');
    }

    public function getRootLocationIds()
    {
        return Zone::whereLocationId(0)->pluck('id');
    }

    public function courts()
    {
        return $this->hasMany(Court::class, 'zone_id');
    }
}
