<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class Currency extends Model
{

    //массовое присваивание
    protected $fillable = ['title', 'code', 'symbol_left', 'symbol_right', 'value', 'base'];
    public $timestamps = false;
}
