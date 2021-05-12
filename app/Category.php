<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use Sluggable;

    //массовое присваивание
    protected $fillable = ['title', 'parent_id', 'keywords', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    //неправильное название
    // public function parents()
    // {
    //     return $this->hasMany(Category::class, 'parent_id');
    // }
    public function childs()
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
    public static function getFilter(Request $request)
    {
        $filter = null;
        if (!empty($request->filter)) {
            $filter = preg_replace("#[^\d,]+#", '', $request->filter);
            $filter = rtrim($filter, ',');
            return $filter;
        }
    }
    public static function getCountFilter($filter)
    {
        //считаем только по группам-если 2 attrs принадлежат одной группе-то count=1
        $filters = explode(',', $filter);
        $attrs = self::getAttrs();
        $data = [];
        foreach ($attrs as $key => $item) {
            foreach ($item as $k => $v) {
                if (in_array($k, $filters)) {
                    $data[] = $key;
                    break;
                }
            }
        }
        return count($data);
        // return $data;
    }
    public static function getAttrs()
    {
        //get from cache or put in cache
        if (Cookie::get('attrs')) {
            $attrs = Cookie::get('attrs');
            $attrs = unserialize($attrs);
        } else {
            $data = DB::select('select * from attribute_value');
            $attrs = [];
            foreach ($data as $k => $v) {
                $attrs[$v->attribute_group_id][$k + 1] = $v->value;
            }
            //для работы с куками
            $attrs = serialize($attrs);
            Cookie::queue('attrs', $attrs, 60 * 24 * 7);
            // Cookie::queue('attrs', $this->attrs, 1);
            //получаем опять объект
            $attrs = unserialize($attrs);
        }
        return $attrs;
    }
}
