<?php

namespace App\Models\Masterdata;

use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function advocates()
    {
        return $this->hasMany(AdvocateCategory::class);
    }

    public function attorneys()
    {
        return $this->hasMany(Attorney::class);
    }
}
