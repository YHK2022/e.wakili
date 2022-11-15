<?php

namespace App\Models\Administrations;

use App\Models\Locations\District;
use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function advocates()
    {
        return $this->hasMany(Advocate::class);
    }

    public function attorneys()
    {
        return $this->hasMany(Attorney::class);
    }
}
