<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Sluggable;

class Order extends Model
{
    use Sluggable;

    protected $fillable = ['user_id', 'status', 'note', 'phone', 'currency_id'];
    //функция расширения Sluggable
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }
    //заказ принадлежит одному пол-лю
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //получить продукты из таблицы order_product
    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
    //date format
    public function getOrderCreate()
    {
        return Carbon::parse($this->created_at)->format('d M Y');
        //другой способ получения формат времени
        // $formatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        // $formatter->setPattern('d MMM Y');
        // return $formatter->format(new DateTime($this->created_at));
    }
    //date format
    public function getOrderUpdate()
    {
        return Carbon::parse($this->updated_at)->format('d M Y');
    }

    //запрос на получение qty and sum
    public function getAttr($attr_str)
    {
        $attr = 0;
        foreach ($this->products as $product) {
            $data = DB::select(
                'select qty,price,title,(price*qty) AS `sum`  from order_product where order_id=? AND product_id = ?',
                [$this->id, $product->id]
            );
            $attr += $data[0]->$attr_str;
        }
        echo $attr;
    }
}
