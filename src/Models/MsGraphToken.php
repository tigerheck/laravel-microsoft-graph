<?php

namespace TigerHeck\MsGraph\Models;

use Illuminate\Database\Eloquent\Model;

class MsGraphToken extends Model
{

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'user_id',
        'access_token',
        'refresh_token',
        'expires_in',
        'token_type',
    ];
    
}