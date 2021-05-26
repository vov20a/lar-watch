<?php

namespace App\Http\Controllers\Admin;

use App\AttributeGroup;
use App\AttributeValue;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class FilterGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = AttributeGroup::orderBy('id', 'desc')->paginate(4);
        // dd($groups);
        return view('admin.filterGroups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.filterGroups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
        ]);
        // dd($request->all());
        AttributeGroup::create($request->all());
        return redirect()
            ->route('filter-groups.index')
            ->with('success', 'Группа добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = AttributeGroup::find($id);
        // dd($group);
        return view('admin.filterGroups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);
        // dd($request->all());
        $group = AttributeGroup::find($id);
        $group->update($request->all());
        return redirect()
            ->route('filter-groups.index')
            ->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = AttributeGroup::find($id);
        $cnt_attrs = $group->attribute_values->count();
        // dd($cnt_attrs);
        //если есть у группы есть атрибуты то удаление невозможно
        if ($cnt_attrs) {
            return redirect()
                ->route('filter-groups.index')
                ->with('error', 'Ошибка! У группы есть атрибуты.');
        }
        $group->delete();
        return redirect()
            ->route('filter-groups.index')
            ->with('success', 'Группа удалена');
    }
}
