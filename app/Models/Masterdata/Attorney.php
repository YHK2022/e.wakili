<?php

namespace App\Models\Masterdata;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Attorney extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function firm()
    {
        return $this->belongsTo(Firm::class);
    }
}
