<?php

namespace App\Models\Cases;

use Illuminate\Database\Eloquent\Model;

class CaseStage extends Model
{
    public function case_register()
    {
        return $this->belongsTo(CaseRegister::class, 'case_register_id');
    }

    public function proceeding_outcome()
    {
        return $this->belongsTo(ProceedingOutcome::class, 'proceeding_outcome_id');
    }
}
