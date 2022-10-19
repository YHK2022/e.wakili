<?php

namespace App\Models\Petitions;

use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
    public function membership()
    {
        return $this->hasMany(FirmMembership::class, 'firm_id');
    }

    public function address()
    {
        return $this->hasMany(FirmAddress::class, 'firm_id');
    }

}
