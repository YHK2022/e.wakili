<?php

namespace App\Models\Petitions;

use App\Models\Petitions\Firm;
use App\User;
use Illuminate\Database\Eloquent\Model;

class FirmMembership extends Model
{
    public function firm()
    {
        return $this->belongsTo(Firm::class, 'firm_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
