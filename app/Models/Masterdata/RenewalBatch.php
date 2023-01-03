<?php

namespace App\Models\Masterdata;

use Illuminate\Database\Eloquent\Model;
use App\Models\Advocate\RenewalHistory;

class RenewalBatch extends Model
{
    public function history()
    {
        return $this->hasMany(RenewalHistory::class);
    }
}
