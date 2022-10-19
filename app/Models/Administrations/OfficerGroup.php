<?php

namespace App\Models\Administrations;

use Illuminate\Database\Eloquent\Model;

class OfficerGroup extends Model
{
    public function officer_positions()
    {
        return $this->hasMany(OfficerPosition::class);
    }

    public function officers()
    {
        return $this->hasMany(Officer::class);
    }
}
