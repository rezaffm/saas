<?php

namespace App\Providers;

use Stripe\Stripe;
use Laravel\Cashier\Cashier;
use Illuminate\Support\ServiceProvider;

class StripeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }
}
