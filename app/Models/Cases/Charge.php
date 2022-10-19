<?php

namespace App\Models\Cases;

use App\Models\Admissions\Admission;
use App\Models\Cases\Criminals\Criminal;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    public function case_register()
    {
        return $this->belongsTo(CaseRegister::class, 'case_register_id');
    }

    public function criminals()
    {
        return $this->belongsToMany(Criminal::class);
    }

    public function admissions()
    {
        return $this->belongsToMany(Admission::class);
    }
}
