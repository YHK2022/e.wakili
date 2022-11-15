<?php

namespace App\Models\Masterdata;

use App\Models\Locations\Zone;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function districts()
    {
        return $this->hasMany(District::class, 'region_id');
    }
}
