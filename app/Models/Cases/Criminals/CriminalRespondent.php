<?php

namespace App\Models\Cases\Criminals;

use Illuminate\Database\Eloquent\Model;

class CriminalRespondent extends Model
{
    protected $table = 'criminal_respondent';
    protected $fillable = ['criminal_id', 'respondent_id'];

    public function criminal()
    {
        return $this->belongsTo(Criminal::class);
    }
}
