<?php

namespace App\Models\Administrations;

use App\Models\Courts\Court;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function officer_group()
    {
        return $this->belongsTo(OfficerGroup::class);
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function officer_position()
    {
        return $this->belongsTo(OfficerPosition::class);
    }

    public function seniority()
    {
        return $this->belongsTo(Seniority::class);
    }
}
