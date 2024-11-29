<?php

namespace App\Providers;

use App\Payment\Paypal\PaypalPaymentGateway;
use App\Payment\Stripe\StripePaymentGateway;
use Illuminate\Support\ServiceProvider;

class PaymentGatewayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PaypalPaymentGateway::class, function () {
            return new PaypalPaymentGateway;
        });
        $this->app->singleton(StripePaymentGateway::class, function () {
            return new StripePaymentGateway;
        });

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
