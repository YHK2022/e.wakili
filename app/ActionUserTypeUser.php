<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionUserTypeUser extends Model
{
    protected $fillable =[
        "user_id", "action_user_type_id"
    ];
    public $timestamps = false;


   
}