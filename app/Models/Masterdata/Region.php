<?php

namespace App\Models\Masterdata;

use App\Models\Locations\Zone;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    // protected $fillable = ['active', 'created_at','deleted_at', 'uid', 'updated_at', 'deleted',
    //                         'name', 'created_by', 'updated_by'];

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function districts()
    {
        return $this->hasMany(District::class, 'region_id');
    }
}