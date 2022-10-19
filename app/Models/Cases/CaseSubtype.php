<?php

namespace App\Models\Cases;

use App\Models\Admissions\Admission;
use App\Models\Cases\Criminals\Criminal;
use Illuminate\Database\Eloquent\Model;

class CaseSubtype extends Model
{
    public function case_register()
    {
        return $this->belongsTo(CaseRegister::class, 'case_register_id');
    }

    public function case_type()
    {
        return $this->belongsTo(CaseType::class, 'case_type_id');
    }

    public function criminals()
    {
        return $this->hasMany(Criminal::class);
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class);
    }
}
