<?php

namespace App\Http\Controllers\Admin;

use App\AttributeGroup;
use App\AttributeValue;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attrs = DB::table('attribute_values')
            ->join('attribute_groups', 'attribute_groups.id', '=', 'attribute_values.attribute_group_id')
            ->select('attribute_values.*', 'attribute_groups.title')
            ->paginate(10);
        // dd($attrs);
        return view('admin.filterAttributes.index', compact('attrs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = AttributeGroup::pluck('title', 'id')->all();
        // dd($groups);
        return view('admin.filterAttributes.create', compact('groups'));
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
            'value' => 'required',
            'attribute_group_id' => 'required|integer',
        ]);

        AttributeValue::create($request->all());
        return redirect()
            ->route('filter-attributes.index')
            ->with('success', 'Атрибут добавлен');
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
        $groups = AttributeGroup::pluck('title', 'id')->all();
        $attr = AttributeValue::find($id);
        // dd($attr);
        return view('admin.filterAttributes.edit', compact('attr', 'groups'));
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
        // dd($request->all());
        $request->validate([
            'value' => 'required',
            'attribute_group_id' => 'required|integer',
        ]);
        // dd($request->all());
        $attr = AttributeValue::find($id);
        $attr->update($request->all());
        return redirect()
            ->route('filter-attributes.index')
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
        $attr = AttributeValue::find($id);
        $attr->delete();
        return redirect()
            ->route('filter-attributes.index')
            ->with('success', 'Атрибут удален');
    }
}
