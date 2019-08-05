<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //BY IQBALCAKEP
    public $timestamps = false;
    protected $fillable = [
        'username',
        'password'
      ];
}
