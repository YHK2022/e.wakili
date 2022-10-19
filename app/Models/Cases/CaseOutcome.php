<?php

namespace App\Models\Cases;

use Illuminate\Database\Eloquent\Model;

class CaseOutcome extends Model
{
    public function case_register()
    {
        return $this->belongsTo(CaseRegister::class, 'case_register_id');
    }

    public function mode_determination()
    {
        return $this->belongsTo(ModeDetermination::class, 'mode_determination_id');
    }

    public function proceeding_outcome()
    {
        return $this->belongsTo(ProceedingOutcome::class, 'proceeding_outcome_id');
    }
}
