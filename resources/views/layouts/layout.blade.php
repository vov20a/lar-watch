<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>

<head>
    {{-- <title>Luxury Watches A Ecommerce Category Flat Bootstrap Resposive Website Template | Home :: w3layouts</title> --}}
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Luxury Watches Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />

    <link href="{{ asset('public/assets/front/css/front.css') }}" rel='stylesheet'>
    <link rel="shortcut icon" href="{{ asset('assets/front/images/star.png') }}" type="image/x-icon" />

</head>

<body>
    <!--top-header-->
    <div class="top-header">
        <div class="container">
            <div class="top-header-main">
                <div class="col-md-6 top-header-left">
                    <div class="drop">
                        <div class="box">
                            <ul id="currency" class="">
                                @include('layouts.partials.currency_ul')
                            </ul>
                        </div>
                        <div class="box1">
                            <ul>
                                @if (Auth::check())
                                    <li>Вход : {{ Auth::user()->name }}&nbsp;/&nbsp;</li>
                                    <li><a href="{{ route('logout') }}">Выход</a></li>
                                @else
                                    <li><a href="{{ route('login.create') }}">Вход&nbsp;/&nbsp;</a></li>
                                    <li><a href="{{ route('register.create') }}">Регистрация</a></li>
                                @endif
                            </ul>
                        </div>
                        {{-- <div class="clearfix"></div> --}}
                    </div>
                </div>
                <div class="col-md-6 cart-price">
                    <div class="cart box_1">
                        <button type="button" onclick="getCart()" class="button cart-button" data-toggle="modal"
                            data-target="#modal-cart" data-token="{{ csrf_token() }}">
                            <img src="{{ asset('assets/front/images/cart-1.png') }}" alt="" />
                            @if (session('cart_sum')[0] > 1)
                                <span
                                    class="cart-sum">{{ session('cart_currency')->symbol_left }}{{ round(session('cart_sum')[0], 2) }}{{ session('cart_currency')->symbol_right }}</span>
                            @else
                                <span class="cart-sum">Empty Cart</span>
                            @endif
                        </button>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--top-header-->

    <!--start-logo-->
    <div class="logo">
        <a href="{{ route('home') }}">
            <h1>Luxury Watches</h1>
        </a>
    </div>

    <!--start-logo-->
    <!--bottom-header-->
    @include('header-bottom')
    @include('layouts.errors')
    <!--banner-starts-->
    @if (isset($has_banner) && $has_banner)
        @include('banner')
        <div class="about">
            <div class="container">
                <div class="about-top grid-1">
                    <div class="col-md-4 about-left">
                        <figure class="effect-bubba">
                            <img class="img-responsive" src="public/assets/front/images/abt-1.jpg" alt="" />
                            <figcaption>
                                <h2>Nulla maximus nunc</h2>
                                <p>In sit amet sapien eros Integer dolore magna aliqua</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-md-4 about-left">
                        <figure class="effect-bubba">
                            <img class="img-responsive" src="public/assets/front/images/abt-2.jpg" alt="" />
                            <figcaption>
                                <h4>Mauris erat augue</h4>
                                <p>In sit amet sapien eros Integer dolore magna aliqua</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-md-4 about-left">
                        <figure class="effect-bubba">
                            <img class="img-responsive" src="public/assets/front/images/abt-3.jpg" alt="" />
                            <figcaption>
                                <h4>Cras elit mauris</h4>
                                <p>In sit amet sapien eros Integer dolore magna aliqua</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--about-end-->
    @endif

    @yield('content')

    <!--information-starts-->
    @include('information')
    <!--footer-starts-->
    <div class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="col-md-6 footer-left">
                    <form>
                        <input type="text" value="Enter Your Email" onfocus="this.value = '';"
                            onblur="if (this.value == '') {this.value = 'Enter Your Email';}">
                        <input type="submit" value="Subscribe">
                    </form>
                </div>
                <div class="col-md-6 footer-right">
                    <p>© 2015 Luxury Watches. All Rights Reserved | Design by <a href="http://w3layouts.com/"
                            target="_blank">W3layouts</a> </p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--footer-end-->
    <script>
        let path = '{{ env('APP_URL') }}';

    </script>
    <script src="{{ asset('public/assets/front/js/front.js') }}"></script>
    <!-- Modal -->
    @include('layouts.modal')
</body>

</html>
