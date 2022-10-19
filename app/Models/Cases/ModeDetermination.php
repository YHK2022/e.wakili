<?php

namespace App\Models\Cases;

use Illuminate\Database\Eloquent\Model;

class ModeDetermination extends Model
{
    public function case_register()
    {
        return $this->belongsTo(CaseRegister::class, 'case_register_id');
    }

    public function case_outcomes()
    {
        return $this->hasMany(CaseOutcome::class, 'mode_determination_id');
    }
}
