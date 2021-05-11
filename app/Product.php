<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;

class Product extends Model
{
    use Sluggable;
    protected $fillable = [
        'title', 'category_id', 'img', 'content', 'price', 'status',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
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
    //загрузка файлов
    public static function uploadImage(Request $request, $image = null)
    {
        //image-это то что в БД
        //request-это то что приходит $_POST
        if ($request->hasFile('img')) {
            //картинка пришла     //delete старый image
            if ($image)    Storage::delete($image);
            //create new image
            $folder = date('Y-m-d');
            return  $request->file('img')->store("products/{$folder}");
        }
        //нет картинки
        return null;
    }
    //выводит картинку на экран
    public function getImage()
    {
        if (!$this->img) {
            return asset('uploads/products/no-image.png');
        }
        return asset("uploads/{$this->img}");
    }
    //recently viewed products
    public static function setRecentlyViewed($id)
    {
        $recentlyViewed = self::getAllRecentlyViewed();
        if (!$recentlyViewed) {
            Cookie::queue('recentlyViewed', $id, 60 * 24 * 7);
        } else {
            $recentlyViewed = explode('.', $recentlyViewed);
            if (!in_array($id, $recentlyViewed)) {
                $recentlyViewed[] = $id;
                $recentlyViewed = implode('.', $recentlyViewed);
                Cookie::queue('recentlyViewed', $recentlyViewed,  60 * 24 * 7);
            }
        }
    }
    public static  function getRecentlyViewed()
    {
        if (!empty(Cookie::get("recentlyViewed"))) {
            $recentlyViewed = Cookie::get("recentlyViewed");
            $recentlyViewed = explode('.', $recentlyViewed);
            return array_slice($recentlyViewed, -3);
        }
        return false;
    }
    public static  function getAllRecentlyViewed()
    {
        if (!empty(Cookie::get("recentlyViewed"))) {
            return Cookie::get("recentlyViewed");
        }
        return false;
    }
}
