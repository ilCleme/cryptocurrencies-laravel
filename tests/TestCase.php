<?php

namespace IlCleme\Cryptocurrencies\Test;

use IlCleme\Cryptocurrencies\Providers\CryptocurrenciesServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [CryptocurrenciesServiceProvider::class];
    }
}
