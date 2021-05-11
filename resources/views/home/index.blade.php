@extends('layouts.layout')
@section('title', 'Luxury Watches:Home')
@section('content')
<!--product-starts-->
<div class="product">
    @php
    use App\Http\ViewComposers\CurrencyComposer;
    $currency=CurrencyComposer::getStart();
    @endphp
    <div class="container">
        <div class="product-top">
            <div class="product-one">
                @foreach ($products as $item)
                <div class="col-md-3 product-left">
                    <div class="product-main simpleCart_shelfItem">
                        <a href="{{ route('products.single', ['slug' => $item->slug]) }}" class="mask"><img
                                class="img-responsive zoom-img" src="{{ $item->getImage() }}" alt="" /></a>
                        <div class="product-bottom">
                            <h3>{{ $item->title }}</h3>
                            <h4><a class="item_add add-to-cart" href="{{ route('cart.single',['id'=>$item->id]) }}"
                                    data-id={{ $item->id }}><i></i></a>
                                <span class=" item_price">{{ $currency->symbol_left }}
                                    {{ round($item->price*$currency->value,2)  }}{{ $currency->symbol_right }}</span>
                            </h4>
                        </div>
                        <div class="srch">
                            <span>-50%</span>
                        </div>
                    </div>
                </div>
                @endforeach


                <div class="clearfix"></div>
            </div>
            {{-- <div class="product-one">
                <div class="col-md-3 product-left">
                    <div class="product-main simpleCart_shelfItem">
                        <a href="single.html" class="mask"><img class="img-responsive zoom-img"
                                src="public/assets/front/images/p-5.png" alt="" /></a>
                        <div class="product-bottom">
                            <h3>Smart Watches</h3>
                            <p>Explore Now</p>
                            <h4><a class="item_add" href="#"><i></i></a> <span class=" item_price">$ 329</span></h4>
                        </div>
                        <div class="srch">
                            <span>-50%</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 product-left">
                    <div class="product-main simpleCart_shelfItem">
                        <a href="single.html" class="mask"><img class="img-responsive zoom-img"
                                src="public/assets/front/images/p-6.png" alt="" /></a>
                        <div class="product-bottom">
                            <h3>Smart Watches</h3>
                            <p>Explore Now</p>
                            <h4><a class="item_add" href="#"><i></i></a> <span class=" item_price">$ 329</span></h4>
                        </div>
                        <div class="srch">
                            <span>-50%</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 product-left">
                    <div class="product-main simpleCart_shelfItem">
                        <a href="single.html" class="mask"><img class="img-responsive zoom-img"
                                src="public/assets/front/images/p-7.png" alt="" /></a>
                        <div class="product-bottom">
                            <h3>Smart Watches</h3>
                            <p>Explore Now</p>
                            <h4><a class="item_add" href="#"><i></i></a> <span class=" item_price">$ 329</span></h4>
                        </div>
                        <div class="srch">
                            <span>-50%</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 product-left">
                    <div class="product-main simpleCart_shelfItem">
                        <a href="single.html" class="mask"><img class="img-responsive zoom-img"
                                src="public/assets/front/images/p-8.png" alt="" /></a>
                        <div class="product-bottom">
                            <h3>Smart Watches</h3>
                            <p>Explore Now</p>
                            <h4><a class="item_add" href="#"><i></i></a> <span class=" item_price">$ 329</span></h4>
                        </div>
                        <div class="srch">
                            <span>-50%</span>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div> --}}
        </div>
    </div>
</div>
<!--product-end-->

@endsection
