<?php

namespace App\Models\Advocate;

use App\Profile;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

}
