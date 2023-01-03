<?php

namespace App\Models\Petitions;

use App\Models\Advocate\Advocate;
use App\Models\Petitions\BillItem;
use App\Models\Masterdata\FeeType;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{

    public function bill_item()
    {
        return $this->hasMany(BillItem::class);
    }

    public function fee_type()
    {
        return $this->belongsTo(FeeType::class, 'fee_type_id');
    }

    public function advocate()
    {
        return $this->belongsTo(Advocate::class, 'profile_id');
    }

}
