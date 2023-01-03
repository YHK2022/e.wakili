<?php

namespace App\Models\Masterdata;

use App\Models\Petitions\BillItem;
use Illuminate\Database\Eloquent\Model;
use App\Models\Masterdata\FeeType;

class Fee extends Model
{

    public function fee_type()
    {
        return $this->belongsTo(FeeType::class, 'fee_type_id');
    }

    public function bill_item()
    {
        return $this->hasMany(BillItem::class);
    }
}
