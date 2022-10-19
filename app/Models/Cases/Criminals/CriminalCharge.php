<?php

namespace App\Models\Cases\Criminals;

use Illuminate\Database\Eloquent\Model;

class CriminalCharge extends Model
{
    protected $table = 'charge_criminal';
    protected $fillable = ['charge_id', 'criminal_id'];

    public function criminal()
    {
        return $this->belongsTo(Criminal::class);
    }
}
