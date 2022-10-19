<?php

namespace App\Models\Cases;

use App\Models\Cases\Criminals\Criminal;
use Illuminate\Database\Eloquent\Model;

class Respondent extends Model
{
    public function criminals()
    {
        return $this->belongsToMany(Criminal::class);
    }
}
