<?php

namespace App\Models\Masterdata;

use Illuminate\Database\Eloquent\Model;
use App\Models\Petitions\Application;

class ActionUserType extends Model
{
    public function application()
    {
        return $this->hasMany(Application::class);
    }
}

