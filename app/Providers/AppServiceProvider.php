<?php

namespace App\Providers;

use App\Category;
use App\Post;
use App\Http\ViewComposers\MenuComposer;
use App\Http\ViewComposers\CurrencyComposer;
use App\Http\ViewComposers\FilterComposer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        //создаем filter в categories views
        view()->composer('layouts.partials.filter', FilterComposer::class);
        //создаем виджет валют в search-cart.blade
        view()->composer('layouts.partials.currency_ul', CurrencyComposer::class);
        // menu of site
        view()->composer('layouts.partials.menu_ul', MenuComposer::class);

        //создаем одно отображение категорий -в нескольких видах
        view()->composer([
            'layouts.partials.menu_ul', 'admin.layouts.partials.tab_menu',
            'admin.layouts.partials.select_menu', 'admin.layouts.partials.select_product',
        ], MenuComposer::class);
    }
}
