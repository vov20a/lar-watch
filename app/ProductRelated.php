<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductRelated extends Model
{
    public function products()
    {
        return $this->belongsTo(Product::class, 'related_id');
    }
}
