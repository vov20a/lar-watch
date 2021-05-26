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
        return $this->hasMany(Preview::class);
    }

    public function previews()
    {
        return $this->belongsToMany(Preview::class);
    }

    public function relateds()
    {
        return $this->hasMany(ProductRelated::class);
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
            return asset('uploads/products/no-image.jpg');
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
    public function editFilter($id, $data)
    {

        $filter = Attribute_Product::where('product_id', $id)->pluck('attr_id', 'id')->all();
        // dd($data['attrs']);
        // dump(!empty($data['attrs']));
        //no filters(for checkbox)-- we have radio box
        if (empty($data['attrs']) && !empty($filter)) {
            // dd(111);
            //SQL query
            // \R::exec("DELETE FROM attribute_product WHERE product_id = ?", [$id]);
            Attribute_Product::where(['product_id' => $id])->delete();
            return;
        }
        // add filters
        if (empty($filter) && !empty($data['attrs'])) {
            // dd(222);
            // dd($data['attrs']);
            $arr = [];
            foreach ($data['attrs'] as $key => $value) {
                $arr[] = [
                    'product_id' => $id,
                    'attr_id' => $value
                ];
            }
            Attribute_Product::insert($arr);
            // dd(1);
            // \R::exec("INSERT INTO attribute_product (attr_id,product_id) VALUES $sql_part");
            return;
        }
        //фильтры изменились - удалим старые и запишем новые
        if (!empty($data['attrs'])) {
            // dd(333);
            //changed something
            $result = array_diff($filter, $data['attrs']);
            //insert new
            if (!empty($result)  || count($filter) != count($data['attrs'])) {
                Attribute_Product::where(['product_id' => $id])->delete();
                $arr = [];
                foreach ($data['attrs'] as $key => $value) {
                    $arr[] = [
                        'product_id' => $id,
                        'attr_id' => $value
                    ];
                }
                Attribute_Product::insert($arr);
                // \R::exec("INSERT INTO attribute_product (attr_id,product_id) VALUES $sql_part");
            }
        }
    }
    public function editRelatedProduct($id, $data)
    {
        $related = ProductRelated::where('product_id', $id)->pluck('related_id', 'id')->all();
        // dd($data['related_products']);
        // dump(!empty($data['attrs']));
        //no filters(for checkbox)-- we have radio box
        if (empty($data['related_products']) && !empty($related)) {
            // dd(111);
            //SQL query
            // \R::exec("DELETE FROM attribute_product WHERE product_id = ?", [$id]);
            Attribute_Product::where(['product_id' => $id])->delete();
            return;
        }
        // add filters
        if (empty($related) && !empty($data['related_products'])) {
            // dd(222);
            // dd($data['attrs']);
            $arr = [];
            foreach ($data['related_products'] as $key => $value) {
                $arr[] = [
                    'product_id' => $id,
                    'related_id' => $value
                ];
            }
            ProductRelated::insert($arr);
            // dd(1);
            // \R::exec("INSERT INTO attribute_product (attr_id,product_id) VALUES $sql_part");
            return;
        }
        //фильтры изменились - удалим старые и запишем новые
        if (!empty($data['related_products'])) {
            // dd(333);
            //changed something
            $result = array_diff($related, $data['related_products']);
            //insert new
            if (!empty($result)  || count($related) != count($data['related_products'])) {
                ProductRelated::where(['product_id' => $id])->delete();
                $arr = [];
                foreach ($data['related_products'] as $key => $value) {
                    $arr[] = [
                        'product_id' => $id,
                        'related_id' => $value
                    ];
                }
                ProductRelated::insert($arr);
                // \R::exec("INSERT INTO attribute_product (attr_id,product_id) VALUES $sql_part");
            }
        }
    }
}
