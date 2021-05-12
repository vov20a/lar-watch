<!-- Left Side Of Navbar -->
<select class="list-group-item" name="parent_id" required>
    {{-- @if (Request::is('admin/categories/create') || Request::is('admin/categories/show')) --}}
    <option class="item-p" value="0">Самостоятельная категория</option>
    {{-- @endif
     --}}
    @php

    function buildMenu($items, $parent,$tab='')
    {

    foreach ($items as $item) {
    if (isset($item->children)) {
    @endphp


    <option class="item-p" value="{{ $item->id }}" @php if(session()->get('parent_id')==$item->id) echo ' selected'
        ;if(session()->get('id')==$item->id)echo ' disabled'; @endphp >@php echo $tab @endphp
        {{ $item->title }}
    </option>

    @php $tab.='--'; buildMenu($item->children, $item->id,$tab);$tab='';

    } else {
    $tab.='';
    @endphp

    <option class="item-p" value="{{ $item->id }}" @php if(session()->get('parent_id')== $item->id) echo ' selected'
        ;if(session()->get('id')==$item->id)echo ' disabled';@endphp >@php echo $tab @endphp
        {{ $item->title }}
    </option>

    @php
    }
    }
    }
    $tab='';
    buildMenu($menuitems, 'mainMenu');
    session()->forget('parent_id');
    session()->forget('id');
    @endphp

</select>
