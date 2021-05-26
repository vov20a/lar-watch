<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/', "HomeController@index")->name('home');
//category
Route::get('/category/{slug}', 'CategoryController@show')->name(
    'categories.single'
);
//product
Route::get('/product/{slug}', 'ProductController@show')->name(
    'products.single'
);
//search
Route::get('/search', 'SearchController@index')->name('search');
//change currency
Route::get('/currency', 'CurrencyController@change')->name('currency.change');
//добавить товар в корзину
Route::get('/cart/{id}', 'CartController@add')->name('cart.single');
//cart оформить заказ
Route::get('/checkout', 'CartController@checkout')->name('checkout');

//показать корзину при первом клике на корзину после перезагрузки(одно действие(showCart) из разных страниц)
Route::post('/cart', 'CartController@show');
Route::post('category/cart', 'CartController@show');
Route::post('product/cart', 'CartController@show');

//удаление одного товара(одно действие(delItem) из разных страниц)
Route::post('/del', 'CartController@delItem');
Route::post('category/del', 'CartController@delItem');
Route::post('product/del', 'CartController@delItem');
Route::post('checkout/del', 'CartController@delItem');

//очищает корзину(одно действие(clearCart) из разных страниц)
Route::post('/clear', 'CartController@clearCart');
Route::post('category/clear', 'CartController@clearCart');
Route::post('product/clear', 'CartController@clearCart');

//correct qty
Route::post('checkout/change-cart', 'CartController@changeCart');

//auth routes
Route::group(['middleware' => 'guest'], function () {
    //register-показ формы регистрации
    Route::get('/register', 'UserController@create')->name('register.create');
    //register-прием данных из формы
    Route::post('/register', 'UserController@store')->name('register.store');
    //auth-показ формы авторизации
    Route::get('/login', 'UserController@loginForm')->name('login.create');
    //авторизация-прием данных из формы
    Route::post('/login', 'UserController@login')->name('login');
});
//выход из авторизации
Route::get('/logout', 'UserController@logout')->name('logout')->middleware('auth');

//Восстановление пароля
//получаем email из формы для восстановления пароля
Route::post('/forgot', 'ForgotController@restore')->name('forgot');
//возврат по ссылке с get- параметром hash
Route::get('/link/{hash}', 'ForgotController@restore')->name('link');
//получаем новый пароль от usera
Route::post('/create', 'ForgotController@create')->name('create.password');
//ограничиваем доступ к стр restore и create методом GET
Route::group(['middleware' => 'forgot'], function () {
    Route::get('/forgot', 'ForgotController@restore');
    Route::get('/create', 'ForgotController@create');
});

//email
Route::post('/send', 'CartController@send')->name('send.mail');


// Route::get('/admin', 'Admin\MainController@index');


//admin routes
Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => 'admin',
    ],
    function () {
        //===admin change status=====
        Route::post('/order/status', 'OrderController@status')->name('changeStatus');
        //clear cache and cookie
        Route::match(['get', 'delete'], '/clear', 'CacheClearController@clear')->name('clear');

        Route::get('/', 'MainController@index')->name('admin.index');
        //имена маршрутов см по команде $ php artisan route:list --path=admin/cat-уже заданы 7 шт
        Route::resource('/categories', 'CategoryController');
        //имена маршрутов см по команде $ php artisan route:list --path=admin/user-уже заданы 7 шт
        Route::resource('/users', 'UserController');
        //имена маршрутов см по команде $ php artisan route:list --path=admin/order-уже заданы 7 шт
        Route::resource('/orders', 'OrderController');
        //имена маршрутов см по команде $ php artisan route:list --path=admin/related-product-уже заданы 7 шт
        Route::resource('/products', 'ProductController');
        //имена маршрутов см по команде $ php artisan route:list --path=admin/currency-уже заданы 7 шт
        Route::resource('/currencies', 'CurrencyController');
        //имена маршрутов см по команде
        Route::resource('/filter-groups', 'FilterGroupController');
        //имена маршрутов см по команде
        Route::resource('/filter-attributes', 'FilterAttributeController');
    }
);
