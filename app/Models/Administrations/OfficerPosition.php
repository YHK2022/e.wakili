<?php

namespace App\Models\Administrations;

use Illuminate\Database\Eloquent\Model;

class OfficerPosition extends Model
{
    public function officer_group()
    {
        return $this->belongsTo(OfficerGroup::class);
    }

    public function seniorities()
    {
        return $this->hasMany(Seniority::class);
    }

    public function officers()
    {
        return $this->hasMany(Officer::class);
    }
}
