<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Paginator::useBootstrap();        

        Blade::directive('isAdmin', function() {
            return "<?php if(Auth::check() && Auth::user()->isAdmin()): ?>";
        });
    
        Blade::directive('endisAdmin', function() {
            return "<?php endif; ?>";
        });

        Blade::directive('isNotAdmin', function() {
            return "<?php if((Auth::check() && !Auth::user()->isAdmin()) || !Auth::check()): ?>";
        });
    
        Blade::directive('endisNotAdmin', function() {
            return "<?php endif; ?>";
        });
    }
}
