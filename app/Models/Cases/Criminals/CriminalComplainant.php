<?php

namespace App\Models\Cases\Criminals;

use Illuminate\Database\Eloquent\Model;

class CriminalComplainant extends Model
{
    protected $table = 'complainant_criminal';
    protected $fillable = ['criminal_id', 'complainant_id'];

    public function criminal()
    {
        return $this->belongsTo(Criminal::class);
    }
}
