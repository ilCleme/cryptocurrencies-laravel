<?php

/**
 * Cryptocompare gateway required parameters configuration
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Gateways Default
    |--------------------------------------------------------------------------
    |
    | This are the default gateway will be registered on manager
    |
    */
    'gateways' => [
        \IlCleme\Cryptocurrencies\Gateways\Cryptocompare\CryptocompareGeneralInfoGateway::class,
        \IlCleme\Cryptocurrencies\Gateways\Cryptocompare\CryptocompareHistoricalGateway::class,
        \IlCleme\Cryptocurrencies\Gateways\Cryptocompare\CryptocomparePriceGateway::class,
        \IlCleme\Cryptocurrencies\Gateways\Cryptocompare\CryptocompareTopListsGateway::class,
        \IlCleme\Cryptocurrencies\Gateways\Coinmarketcap\CoinmarketcapGateway::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Cryptocompare Default parameters
    |--------------------------------------------------------------------------
    |
    | This are the default parameter used to send request to cryptocompare
    |
    */
    'cryptocompare' => [

        /**
         * The cryptocurrency symbol of interest
         */
        'fsym' => env('CRYPTOCOMPARE_FSYM', 'BTC'),

        /**
         * Comma separated cryptocurrency symbols list to convert into
         */
        'tsym' => env('CRYPTOCOMPARE_TSYM', 'USD'),

        /**
         * The exchange to obtain data from
         */
        'e' => env('CRYPTOCOMPARE_DEFAULT_EXCHANGE', 'CCCAGG'),

        /**
         * The name of your application
         */
        'extraParams' => env('CRYPTOCOMPARE_APP_NAME', 'PHP Application'),

        /**
         * Api key from cryptocompare
         */
        'api_key' => env('CRYPTOCOMPARE_API_KEY', ''),

    ],

    /*
    |--------------------------------------------------------------------------
    | Coinmarketcap Default parameters
    |--------------------------------------------------------------------------
    |
    | This are the default parameter used to send request to cryptocompare
    |
    */
    'coinmarketcap' => [

        /**
         * Api key from cryptocompare
         */
        'api_key' => env('COINMARKETCAP_API_KEY', ''),

        /**
         * Can switch application to use sandbox endpoint instead of production ready endpoint
         */
        'sandbox_mode' => env('COINMARKETCAP_SANDBOX_MODE', true),

        /**
         * Sandbox endpoint
         */
        'sandbox_url' => 'https://sandbox-api.coinmarketcap.com',

        /**
         * Production ready endpoint
         */
        'production_url' => 'https://pro-api.coinmarketcap.com',
    ],
];
