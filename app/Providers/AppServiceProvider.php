<?php

namespace App\Providers;

use App\Menu;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        // set value for all views use
        $MENUS = Menu::where('delete_statue',0)->orderBy('ordering','asc')->get();

        View::share(['MENUS'=>$MENUS]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
