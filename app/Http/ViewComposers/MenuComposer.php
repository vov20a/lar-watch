<?php

namespace App\Http\ViewComposers;

use App\Category;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

class MenuComposer
{
    public function compose(View $view)
    {
        //get cache or put in cache
        $tree = null;
        if (Cache::has('menus')) {
            $tree = Cache::get('menus');
        } else {
            //жадная загрузка
            $menu = Category::with('parent')->get();
            //обычная(ленивая) загрузка
            // $menu = Category::all();
            $tree = $this->buildTree($menu);
            Cache::put('menus', $tree, 60 * 24 * 7);
        }
        //dd($tree);
        // dump(session()->get('id'));

        return $view->with('menuitems', $tree);
    }
    public function buildTree($items)
    {
        $grouped = $items->groupBy('parent_id');

        foreach ($items as $item) {
            if ($grouped->has($item->id)) {
                $item->children = $grouped[$item->id];
            }
        }

        return $items->where('parent_id', null);
    }
}
