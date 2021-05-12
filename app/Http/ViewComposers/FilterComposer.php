<?php

namespace app\Http\ViewComposers;

use App\AttributeGroup;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class FilterComposer
{
    public $groups;
    public $attrs;

    public function compose(View $view)
    {
        $this->groups = $this->getGroups();
        $this->attrs = $this->getAttrs();
        // dd($this->groups, $this->attrs);
        return $view->with(['groups' => $this->groups, 'attrs' => $this->attrs]);
    }
    public function getGroups()
    {
        //get from cache or put in cache
        if (Cookie::get('groups')) {
            $this->groups = Cookie::get('groups');
            $this->groups = unserialize($this->groups);
        } else {
            $this->groups = AttributeGroup::pluck('title', 'id')->all();
            // dd($this->groups);
            //для работы с куками
            $this->groups = serialize($this->groups);
            // Cookie::queue('groups', $this->groups, 60 * 24 * 7);
            Cookie::queue('groups', $this->groups, 1);
            //получаем опять объект
            $this->groups = unserialize($this->groups);
        }
        return $this->groups;
    }
    public function getAttrs()
    {
        //get from cache or put in cache
        if (Cookie::get('attrs')) {
            $this->attrs = Cookie::get('attrs');
            $this->attrs = unserialize($this->attrs);
        } else {
            $data = DB::select('select * from attribute_value');
            $attrs = [];
            foreach ($data as $k => $v) {
                $attrs[$v->attribute_group_id][$k + 1] = $v->value;
            }
            //для работы с куками
            $this->attrs = serialize($attrs);
            // Cookie::queue('attrs', $this->attrs, 60 * 24 * 7);
            Cookie::queue('attrs', $this->attrs, 1);
            //получаем опять объект
            $this->attrs = unserialize($this->attrs);
        }
        return $this->attrs;
    }
}
