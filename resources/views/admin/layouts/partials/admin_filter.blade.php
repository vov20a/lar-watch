<div class="card" id="filter">
    <div class="card-header d-flex p-0">
        <h3 class="card-title p-3">Groups:</h3>
        <ul class="nav nav-pills ml-auto p-2">
            @php
            $i = 1;
            foreach ($groups as $group_id => $group_item):
            @endphp
            <li class=" nav-item ml-3"><a class="nav-link @php if ($i==1) { echo ' active' ; } @endphp"
                    href="#tab_<?= $group_id ?>" data-toggle="tab">{{$group_item}} </a></li>
            @php $i++;endforeach;@endphp
            <li class=" nav-item pull-right ml-5"><a class=" nav-link btn-danger" href="#" id="reset-filter">Сброс
                    фильтров</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            @php if (!empty($attrs[$group_id])): @endphp
            @php
            $i = 1;
            foreach ($groups as $group_id => $group_item): @endphp
            <div class="tab-pane @php if ($i == 1) {
                    echo ' active';
                } @endphp" id="tab_{{$group_id }}">
                @php foreach ($attrs[$group_id] as $attr_id => $value): @endphp
                @php if (!empty($filter) && in_array($attr_id, $filter)) {
                $checked = ' checked';
                } else {
                $checked = null;
                } @endphp
                <div class="form-group">
                    <label>
                        <input type="radio" name="attrs[{{$group_id }}]" value="{{$attr_id}}" {{$checked}}>{{$value}}
                    </label>
                </div>
                @php $i++;endforeach; @endphp
            </div>
            @php endforeach;@endphp

            @php endif; @endphp
        </div>
    </div>
</div>
