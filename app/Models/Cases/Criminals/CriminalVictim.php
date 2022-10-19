<?php

namespace App\Models\Cases\Criminals;

use Illuminate\Database\Eloquent\Model;

class CriminalVictim extends Model
{
    protected $table = 'criminal_victim';
    protected $fillable = ['criminal_id', 'victim_id'];

    public function criminal()
    {
        return $this->belongsTo(Criminal::class);
    }
}
