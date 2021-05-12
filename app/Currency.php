<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Currency extends Model
{

    //массовое присваивание
    protected $fillable = ['title', 'code', 'symbol_left', 'symbol_right', 'value', 'base'];
    public $timestamps = false;
    //функция расширения Sluggable
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
