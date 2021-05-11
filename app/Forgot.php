<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forgot extends Model
{
    protected $fillable = ['email', 'hash', 'expire'];
    public $timestamps = false;
}
