<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Preview extends Model
{
    protected $fillable = [
        'product_id', 'img',
    ];

    //загрузка файлов
    public static function uploadImage(Request $request, $k, $preview_col = null)
    {
        //$preview_col-это то что в БД
        //request-это то что приходит $_POST

        //если обновляем не все картинки галлереи
        if (null === $request->file("preview$k")) {
            if (null !== $preview_col)
                return $preview_col->img;
            // else {
            //     $folder = date('Y-m-d');
            //     // return  Storage::put("previews/{$folder}", asset('/uploads/products/no-image.png'));;
            //     return  file_put_contents(asset("/uploads/previews/{$folder}"), asset('/uploads/products/no-image.png'));;
            // }
        }
        if ($request->hasFile("preview$k")) {
            //картинка пришла
            if ($preview_col) {
                Storage::delete($preview_col->img);
            }
            //create new image
            $folder = date('Y-m-d');
            return  $request->file("preview$k")->store("previews/{$folder}");
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
}
