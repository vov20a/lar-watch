@extends('layouts.layout')
@section('title', "Products of category: $category->title ")
@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    {!! $breadcrumbs !!}
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--prdt-starts-->
    <div class="prdt">
        @php
            use App\Http\ViewComposers\CurrencyComposer;
            $currency = CurrencyComposer::getStart();
        @endphp
        <div class="container">
            <div class="prdt-top">
                @if (count($products))
                    <div class="col-md-9 prdt-left">
                        <h2>Products of category: {{ $category->title }}</h2>
                        <div class="product-one">
                            @foreach ($products as $item)
                                <div class="col-md-4 product-left p-left">
                                    <div class="product-main simpleCart_shelfItem">
                                        <a href="{{ route('products.single', ['slug' => $item->slug]) }}"
                                            class="mask"><img class="img-responsive zoom-img"
                                                src="{{ asset($item->getImage()) }}" alt="" /></a>
                                        <div class="product-bottom">
                                            <h3>{{ $item->title }}</h3>
                                            <h4><a class="item_add add-to-cart"
                                                    href="{{ route('cart.single', ['id' => $item->id]) }}"
                                                    data-id={{ $item->id }}><i></i></a><span
                                                    class="item_price">{{ $currency->symbol_left }}
                                                    {{ round($item->price * $currency->value, 2) }}{{ $currency->symbol_right }}</span>
                                            </h4>
                                        </div>
                                        <div class="srch srch1">
                                            <span>-50%</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="clearfix"></div>
                        <div class="" style="padding-left: 15px;">{{ $products->links() }}</div>
                    </div>
                @else
                    <div class="col-md-9 prdt-left">
                        <h2>Category: {{ $category->title }} has not products</h2>
                    </div>
                @endif

                <div class="col-md-3 prdt-right">
                    <div class="w_sidebar">
                        <section class="sky-form">
                            <h4>Catogories</h4>
                            <div class="row1 scroll-pane">
                                <div class="col col-4">
                                    <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>All
                                        Accessories</label>
                                </div>
                                <div class="col col-4">
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Women
                                        Watches</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Kids
                                        Watches</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Men
                                        Watches</label>
                                </div>
                            </div>
                        </section>
                        <section class="sky-form">
                            <h4>Brand</h4>
                            <div class="row1 row2 scroll-pane">
                                <div class="col col-4">
                                    <label class="checkbox"><input type="checkbox" name="checkbox"
                                            checked=""><i></i>kurtas</label>
                                </div>
                                <div class="col col-4">
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Sonata</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Titan</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Casio</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Omax</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>shree</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Fastrack</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Sports</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Fossil</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Maxima</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Yepme</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Citizen</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Diesel</label>
                                </div>
                            </div>
                        </section>
                        <section class="sky-form">
                            <h4>Colour</h4>
                            <ul class="w_nav2">
                                <li><a class="color1" href="#"></a></li>
                                <li><a class="color2" href="#"></a></li>
                                <li><a class="color3" href="#"></a></li>
                                <li><a class="color4" href="#"></a></li>
                                <li><a class="color5" href="#"></a></li>
                                <li><a class="color6" href="#"></a></li>
                                <li><a class="color7" href="#"></a></li>
                                <li><a class="color8" href="#"></a></li>
                                <li><a class="color9" href="#"></a></li>
                                <li><a class="color10" href="#"></a></li>
                                <li><a class="color12" href="#"></a></li>
                                <li><a class="color13" href="#"></a></li>
                                <li><a class="color14" href="#"></a></li>
                                <li><a class="color15" href="#"></a></li>
                                <li><a class="color5" href="#"></a></li>
                                <li><a class="color6" href="#"></a></li>
                                <li><a class="color7" href="#"></a></li>
                                <li><a class="color8" href="#"></a></li>
                                <li><a class="color9" href="#"></a></li>
                                <li><a class="color10" href="#"></a></li>
                            </ul>
                        </section>
                        <section class="sky-form">
                            <h4>discount</h4>
                            <div class="row1 row2 scroll-pane">
                                <div class="col col-4">
                                    <label class="radio"><input type="radio" name="radio" checked=""><i></i>60 % and
                                        above</label>
                                    <label class="radio"><input type="radio" name="radio"><i></i>50 % and above</label>
                                    <label class="radio"><input type="radio" name="radio"><i></i>40 % and above</label>
                                </div>
                                <div class="col col-4">
                                    <label class="radio"><input type="radio" name="radio"><i></i>30 % and above</label>
                                    <label class="radio"><input type="radio" name="radio"><i></i>20 % and above</label>
                                    <label class="radio"><input type="radio" name="radio"><i></i>10 % and above</label>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--product-end-->
@endsection
