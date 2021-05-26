<!-- Left Side Of Navbar -->
<select class="list-group-item @error('title')  is-invalid @enderror" name="category_id" id="category_id" required>
    @php 
    function buildMenu($items, $parent,$tab='')
    {

    foreach ($items as $item) {
    if (isset($item->children)) {
    @endphp

    <option class="item-p" value="{{ $item->id }}" @php if(session()->get('id')==$item->id) echo ' selected'
        ; @endphp >@php echo $tab @endphp
        {{ $item->title }}
    </option>

    @php $tab.='--'; buildMenu($item->children, $item->id,$tab);$tab='';

    } else {
        $tab.=''; 
    @endphp

    <option class="item-p" value="{{ $item->id }}" @php if(session()->get('id')== $item->id) echo ' selected'
        ;@endphp >@php echo $tab @endphp
        {{ $item->title }}
    </option>

    @php
    }
    }
    }
    $tab='';
    
    buildMenu($menuitems, 'mainMenu');
    session()->forget('id');
    @endphp

</select>
