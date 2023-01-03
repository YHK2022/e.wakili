<?php

namespace App\Models\Masterdata;

use App\Models\Masterdata\Fee;
use App\Models\Petitions\Bill;
use Illuminate\Database\Eloquent\Model;

class FeeType extends Model
{

    public function fee()
    {
        return $this->hasMany(Fee::class);
    }

    public function bill()
    {
        return $this->hasMany(Bill::class);
    }

}

