<?php

namespace IlCleme\Cryptocurrencies\Providers;

use IlCleme\Cryptocurrencies\Contracts\CryptcompareManager;
use IlCleme\Cryptocurrencies\Managers\Manager;
use Illuminate\Support\ServiceProvider;

class CryptocurrenciesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/cryptocurrencies.php' => config_path('cryptocurrencies.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CryptcompareManager::class, function () {
            $manager = new Manager();
            foreach (config('cryptocurrencies.gateways', []) as $gateway) {
                $manager->addGateway($this->app[$gateway]);
            }

            return $manager;
        });

        $this->app->alias(CryptcompareManager::class, 'cryptocurrencies.manager');

        $this->mergeConfigFrom(
            __DIR__.'/../../config/cryptocurrencies.php', 'cryptocurrencies'
        );
    }
}
