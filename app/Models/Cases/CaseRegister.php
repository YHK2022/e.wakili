<?php

namespace App\Models\Cases;

use App\Models\Courts\CourtSubmission;
use Illuminate\Database\Eloquent\Model;

class CaseRegister extends Model
{
    public function case_types()
    {
        return $this->hasMany(CaseType::class, 'case_register_id');
    }

    public function case_subtypes()
    {
        return $this->hasMany(CaseSubtype::class, 'case_register_id');
    }

    public function mode_determinations()
    {
        return $this->hasMany(ModeDetermination::class, 'case_register_id');
    }

    public function case_stages()
    {
        return $this->hasMany(CaseStage::class, 'case_register_id');
    }

    public function case_outcomes()
    {
        return $this->hasMany(CaseOutcome::class, 'case_register_id');
    }

    public function case_natures()
    {
        return $this->hasMany(CaseNature::class, 'case_register_id');
    }

    public function case_charges()
    {
        return $this->hasMany(CaseCharge::class, 'case_register_id');
    }

    public function court_submissions()
    {
        return $this->hasMany(CourtSubmission::class);
    }
}
