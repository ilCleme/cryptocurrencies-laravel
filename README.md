# Cryptocurrencies API Laravel Wrapper
Laravel wrapper for the major cryptocurrencies API, provides a easy way to use the third-part API.

[![Latest Stable Version](https://poser.pugx.org/ilcleme/cryptocurrencies-laravel/v/stable)](https://packagist.org/packages/ilcleme/cryptocurrencies-laravel)
[![Total Downloads](https://poser.pugx.org/ilcleme/cryptocurrencies-laravel/downloads)](https://packagist.org/packages/ilcleme/cryptocurrencies-laravel)
[![Latest Unstable Version](https://poser.pugx.org/ilcleme/cryptocurrencies-laravel/v/unstable)](https://packagist.org/packages/ilcleme/cryptocurrencies-laravel)
[![License](https://poser.pugx.org/ilcleme/cryptocurrencies-laravel/license)](https://packagist.org/packages/ilcleme/cryptocurrencies-laravel)

Requirements
------------
The minimum requirement by Cryptocompare API Laravel Wrapper is that you have 
Laravel 5.7 installed and your Web server supports PHP 7.1.

Installation
------------
To install Cryptocurrencies API Laravel Wrapper package you can use simple
```
composer require ilcleme/cryptocurrencies-laravel
```

Usage
------------

After install the package you need to publish the config file to override it, use this command:
```
php artisan vendor:publish --provider="IlCleme\\Cryptocurrencies\\Providers\\CryptocurrenciesServiceProvider"
```
Now you can override the default configuration and insert you personal api key.

This package consists of some important object:
1. Manager object, register in laravel container as `cryptocurrencies.manager`;
2. CryptocompareGeneralInfoGateway, gateway for every api call of "general info" section;
3. CryptocompareHistoricalGateway, gateway for every api call of "Historical data" section;
4. CryptocomparePriceGateway, gateway for every api call of "price" section;
5. CryptocompareTopListsGateway, gateway for every api call of "top list" section;
6. Coinmarketcap Gateway, single gateway to Coinmarketcap endpoint

We have decided to create one gateway for every logical section of API calls presents in _Cryptocompare_ documentation.
To use "price api" you need to:
- get a CryptocurrenciesManager instance from laravel container:
- get the Price gateway instance
- Call the api via methods of this gateway

```php
$manager = $this->app['cryptocurrencies.manager'];
$priceGateway = $manager->getGateway('price');

$result = $priceGateway->getSingleSymbolPrice();
return $result;
```

The full list of gateways is in package configuration file, you can add your custom gateway simply for another third part api service.
Every gateway have a name that is used to retrive it by the manager.

To use the _Coinmarketcap_ gateway use the same logic, the only different is that this gateway have no public method 
that send request "out-of-the-box":

```php
$manager = $this->app['cryptocurrencies.manager'];
$coinmarketcapGateway = $manager->getGateway('coinmarketcap');

$result = $coinmarketcapGateway->send('/v1/cryptocurrency/info');
return $result;
```

API Reference
------------
Here there is [full api reference](docs/API_Cryptocompare.md) implemented in this package for **Cryptocompare API**

Here there is [full api reference](docs/API_Coinmarketcap.md) implemented in this package for **Coinmarketcap API**

Test
----
To run the package test you need to install the dev requirements (test tools) and run phpunit from the package folder
```
composer install --dev
vendor/bin/phpunit tests
```
if you want a more verbose log use this command
```
vendor/bin/phpunit --testdox tests
```
