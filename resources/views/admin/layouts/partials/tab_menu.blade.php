<!-- Left Side Of Navbar -->
{{-- <div class="list-group"> --}}
<tbody>
    @php
    use App\Category;
    function buildMenu($items, $parent)
    {
    foreach ($items as $item) {
    if (isset($item->children)) {
    @endphp
    <tr>
        <td>{{$item->id }}</td>
        <td>
            <a href="{{ route('categories.edit',['category'=>$item->id]) }}"
                class="list-group-item">{{$item->title }}</a>
        </td>
        <td>@if($item->parent===null) 'Самостоятельная категория'@else {{ $item->parent->title }} @endif</td>
        <td>
            <a href="{{ route('categories.edit',['category'=>$item->id]) }}" class="btn btn-info btn-sm"
                style="float: left; margin-right:3px;">
                <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('categories.destroy',['category'=>$item->id]) }}" method="post" class="float-left">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Подтвердите удаление')">
                    <i class="fas fa-cut"></i>
                </button>
            </form>
        </td>
    </tr>
    @php buildMenu($item->children, $item->id); @endphp
    @php
    } else {
    @endphp
    <tr>
        <td>{{$item->id }}</td>
        <td>
            <a href="{{ route('categories.edit',['category'=>$item->id]) }}"
                class="list-group-item">{{$item->title }}</a>
        </td>
        <td>@if($item->parent===null) 'Самостоятельная категория'@else {{ $item->parent->title }} @endif</td>
        <td>
            <a href="{{ route('categories.edit',['category'=>$item->id]) }}" class="btn btn-info btn-sm"
                style="float: left; margin-right:3px;">
                <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('categories.destroy',['category'=>$item->id]) }}" method="post" class="float-left">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Подтвердите удаление')">
                    <i class="fas fa-cut"></i>
                </button>
            </form>
        </td>
    </tr>
    @php
    }
    }
    }
    buildMenu($menuitems, 'mainMenu');
    @endphp

</tbody>


{{-- </div> --}}
