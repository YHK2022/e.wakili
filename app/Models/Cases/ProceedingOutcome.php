<?php

namespace App\Models\Cases;

use Illuminate\Database\Eloquent\Model;

class ProceedingOutcome extends Model
{
    public function case_stages()
    {
        return $this->hasMany(CaseStage::class, 'proceeding_outcome_id');
    }

    public function case_outcomes()
    {
        return $this->hasMany(CaseOutcome::class, 'proceeding_outcome_id');
    }
}
