<?php

namespace App\Providers;

use App\Category;
use App\Post;
use App\Http\ViewComposers\MenuComposer;
use App\Http\ViewComposers\CurrencyComposer;
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
        //создаем виджет валют в search-cart.blade
        view()->composer('layouts.partials.currency_ul', CurrencyComposer::class);
        //создаем меню в section navbar.blade
        //    view()->composer('admin.layouts.partials.tab_menu', MenuComposer::class);
        view()->composer('layouts.partials.menu_ul', MenuComposer::class);
    }
}
