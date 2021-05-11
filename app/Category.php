<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;

    //массовое присваивание
    protected $fillable = ['title', 'parent_id', 'keywords', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function parents()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //функция расширения Sluggable
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
    public function getIds($id, $cats)
    {
        $ids = null;
        foreach ($cats as $k => $v) {
            if ($v['parent_id'] == $id) {
                // dump($k + 1);
                //индексация массива начинается с 0, а нужно с 1
                $ids .= $k + 1 . ',';
                $ids .= $this->getIds($k + 1, $cats);
            }
        }
        return $ids;
    }
}
