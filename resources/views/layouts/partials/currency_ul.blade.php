<li class="label"><span class="curr_selected">{{ $currency['code'] }}
        <span class="glyphicon glyphicon-triangle-bottom icon-curr" aria-hidden="true"></span>
    </span>
    <ul>
        @foreach ($currencies as $k =>$item)
        @if ($k !=$currency['code'])
        <li><span class="curr_change">{{ $item['code'] }}</span></li>
        @endif
        @endforeach
    </ul>
</li>
