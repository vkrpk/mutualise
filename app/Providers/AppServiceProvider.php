<?php

namespace App\Providers;

use App\Services\StripeService;
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

        try {
            $stripe = new \Stripe\StripeClient(
                env('APP_ENV') === 'production' ? env('STRIPE_SECRET_KEY_PROD') : env('STRIPE_SECRET_KEY_DEV')
            );
            // dd($stripe->webhookEndpoints->all()['data']);
            foreach ($stripe->webhookEndpoints->all()['data'] as $webhook) {
                if($webhook->url !== env('APP_URL') . '/success'){
                    $this->stripe->webhookEndpoints->create([
                        'url' => env('APP_URL') . '/success',
                        'enabled_events' => [
                            'charge.succeeded',
                        ],
                    ]);
                }
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
