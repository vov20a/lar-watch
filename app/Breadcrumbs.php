<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Breadcrumbs extends Model
{
    public static function getBreadcrumbs($category_id, $name = '', $is_product = false)
    {
        $cats = Category::all();
        // dump($category_id);
        $cat_arr = self::getArray($cats);
        // dd($cat_arr);
        $breadcrumbs_array = self::getParts($cat_arr, $category_id);
        if ($name != '' && $is_product == false) {
            array_pop($breadcrumbs_array);
        }
        $breadcrumbs = "<li><a href=' " .  route('home')  . " '>Home</a></li>";
        if ($breadcrumbs_array) {
            foreach ($breadcrumbs_array as $slug => $title) {

                $breadcrumbs .= "<li><a href=' " .  route('home') . "/category/{$slug} '>{$title}</a></li> ";
            }
        }

        if ($name) {
            $breadcrumbs .= "<li>$name</li>";
        }
        return $breadcrumbs;
    }
    public static function getParts($cats, $id)
    {
        if (!$id) {
            return [];
        }
        $cats = array_reverse($cats, true);
        $breadcrumbs = [];
        //если дочерняя кат-я стоит выше в таблице, то родители которые ниже-теряются
        // foreach ($cats as $k => $v) {
        //     if ($cats[$k]['id'] == $id) {
        //         $breadcrumbs[$cats[$k]['slug']] = $cats[$k]['title'];
        //         $id = $cats[$k]['parent_id'];
        //     }
        // }
        //этот вариант работает правильно
        foreach ($cats as $k => $v) {
            if (isset($cats[$id])) {
                $breadcrumbs[$cats[$id]['slug']] = $cats[$id]['title'];
                $id = $cats[$id]['parent_id'];
            } else {
                break;
            }
        }
        return array_reverse($breadcrumbs, true);
    }
    public static function getArray($cats)
    {
        $arr = [];
        foreach ($cats as $k => $v) {
            $arr[$k + 1]['id'] = $v->id;
            $arr[$k + 1]['title'] = $v->title;
            $arr[$k + 1]['slug'] = $v->slug;
            $arr[$k + 1]['parent_id'] = $v->parent_id;
        }
        return $arr;
    }
}
