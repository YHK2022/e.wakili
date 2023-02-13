<?php

namespace App\Models\Petitions;

use Illuminate\Database\Eloquent\Model;
use App\Profile;

class Document extends Model
{
    protected $fillable = ['user_id','profile_id', 'name', 'file', 'application_id', 'uid', 'upload_date', 'status', 'auther'];
    public function profile()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
