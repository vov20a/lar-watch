<!-- Left Side Of Navbar -->
<ul>
    @php
    function buildMenu($items, $parent)
    {
    foreach ($items as $item) {
    if (isset($item->children)) {
    @endphp
    <li>
        <a href="{{ route('categories.single',['slug'=>$item->slug]) }}">
            {{ $item->title }}

        </a>
        <ul> @php buildMenu($item->children, $item->id) @endphp
        </ul>
    </li>
    @php
    } else {
    @endphp
    <li>
        @if ($item->slug=='home')
        <a href="{{ route('home')  }}">{{ $item->title }}</a>
        @else
        <a href="{{ route('categories.single',['slug'=>$item->slug])  }}">{{ $item->title }}</a>
        @endif
    </li>
    @php
    }
    }
    }

    buildMenu($menuitems, 'mainMenu')
    @endphp

</ul>
