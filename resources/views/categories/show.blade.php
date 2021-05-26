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
                <div class="col-md-9 prdt-left">
                    <div class="product-one">
                        @if (!$show)
                            @if (count($products))
                                <h2>Products of category: {{ $category->title }}</h2>
                                @foreach ($products as $item)
                                    <div class="col-md-4 product-left p-left">
                                        <div class="product-main simpleCart_shelfItem">
                                            <a href="{{ route('products.single', ['slug' => $item->slug]) }}"
                                                class="mask">
                                                <img class="img-responsive zoom-img" src="{{ asset($item->getImage()) }}"
                                                    alt="" /></a>
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
                                <div class="clearfix"></div>
                                <div class="" style="padding-left: 15px;">
                                    {{ $products->appends(['filter' => $filter])->links() }}
                                </div>
                            @else
                                <h2>Category: {{ $category->title }} has not products</h2>
                            @endif
                        @else
                            @include('categories.filter')
                        @endif
                    </div>
                </div>
                <div class="col-md-3 prdt-right">
                    <div class="w_sidebar">
                        @include('layouts.partials.filter')
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="preloader">
        <img src="{{ asset('assets/front/images/ring.svg') }}" alt="">
    </div>
    <!--product-end-->
@endsection
