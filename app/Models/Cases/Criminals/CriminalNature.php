<?php

namespace App\Models\Cases\Criminals;

use Illuminate\Database\Eloquent\Model;

class CriminalNature extends Model
{
    protected $table = 'criminal_nature';
    protected $fillable = ['criminal_id', 'nature_id'];

    public function criminal()
    {
        return $this->belongsTo(Criminal::class);
    }
}
