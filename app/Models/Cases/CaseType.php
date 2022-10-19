<?php

namespace App\Models\Cases;

use Illuminate\Database\Eloquent\Model;

class CaseType extends Model
{
    public function case_register()
    {
        return $this->belongsTo(CaseRegister::class, 'case_register_id');
    }

    public function case_subtypes()
    {
        return $this->hasMany(CaseSubtype::class, 'case_type_id');
    }
}
