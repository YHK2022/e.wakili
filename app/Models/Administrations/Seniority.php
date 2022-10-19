<?php

namespace App\Models\Administrations;

use Illuminate\Database\Eloquent\Model;

class Seniority extends Model
{
    public function officer_position()
    {
        return $this->belongsTo(OfficerGroup::class);
    }

    public function officers()
    {
        return $this->hasMany(Officer::class);
    }
}
