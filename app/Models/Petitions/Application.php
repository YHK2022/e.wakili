<?php

namespace App\Models\Petitions;

use App\Models\Masterdata\ActionUserType;
use Illuminate\Database\Eloquent\Model;
use App\Profile;
use App\User;

class Application extends Model
{
    public function profile()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function profile_detail()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function stage()
    {
        return $this->belongsTo(ActionUserType::class, 'current_stage');
    }
}
