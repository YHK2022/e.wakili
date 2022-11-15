<?php

namespace App\Models\Locations;

use App\Models\Administrations\Firm;
use App\Models\Admissions\Admission;
use App\Models\Cases\Criminals\Criminal;
use App\Models\Courts\Court;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function courts()
    {
        return $this->hasMany(Court::class, 'district_id');
    }

    public function criminals()
    {
        return $this->hasMany(Criminal::class);
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class);
    }

    public function firms()
    {
        return $this->hasMany(Firm::class);
    }
}
