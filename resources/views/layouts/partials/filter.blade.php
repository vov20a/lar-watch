@foreach ($groups as $group_id=> $group_item)
<section class="sky-form">
    <h4>{{ $group_item}}</h4>
    <div class="row1 scroll-pane">
        <div class="col col-4">
            @foreach ($attrs[$group_id] as $attr_id=>$value)
            @php
            $filter=session()->get('filter');
            if (!empty($filter) && in_array($attr_id, $filter)) {
            $checked = ' checked';
            } else {
            $checked = null;
            }
            @endphp
            <label class="checkbox"><input type="checkbox" name="checkbox" value="{{ $attr_id }} " {{ $checked }}>
                <i></i>{{ $value }}
            </label>
            @endforeach
        </div>
    </div>
</section>
@endforeach
