# Cryptocurrencies API Laravel Manager
Laravel wrapper for the main cryptocurrencies APIs, provides an easy way to use the third-part API.
Recover a gateway from the cryptocurrencies Manager and start to query the chosen API. 

[![Latest Stable Version](https://poser.pugx.org/ilcleme/cryptocurrencies-laravel/v/stable)](https://packagist.org/packages/ilcleme/cryptocurrencies-laravel)
[![Total Downloads](https://poser.pugx.org/ilcleme/cryptocurrencies-laravel/downloads)](https://packagist.org/packages/ilcleme/cryptocurrencies-laravel)
[![Latest Unstable Version](https://poser.pugx.org/ilcleme/cryptocurrencies-laravel/v/unstable)](https://packagist.org/packages/ilcleme/cryptocurrencies-laravel)
[![License](https://poser.pugx.org/ilcleme/cryptocurrencies-laravel/license)](https://packagist.org/packages/ilcleme/cryptocurrencies-laravel)

Requirements
------------
The minimum requirement by Cryptocurrencies API Laravel Manager is Laravel 5.7 installed and your Web server supports PHP 7.1.

Installation
------------
To install Cryptocurrencies API Laravel Manager package you can use a simple composer command.
```
composer require ilcleme/cryptocurrencies-laravel
```
Publish Vendor
--------------
This step is fundamental to use every API calls. 
After install the package you could publish the config package file, use this command:
```
php artisan vendor:publish --provider="IlCleme\\Cryptocurrencies\\Providers\\CryptocurrenciesServiceProvider"
```
Now you can override the default configuration and insert you personal **api key for every third-part service**.

Architecture
------------
The package contains 3 main objects that have been used to interact with the bees:
- Cryptocurrencies API Manager (`cryptocurrencies.manager` is container alias on Laravel);
- Gateways, that is objects implemented to query third-party APIs, everyone have a name used to retrive it from manager;

Available gateways:
- For Cryptocompare there are 4 gateways available "out-of-box", one per section available on Cryptocompare docs:
	1. Cryptocompare "General Information", for every api calls of "general info" section;
	2. Cryptocompare "Historical data", for every api calls of "Historical data" section;
	3. Cryptocompare "Price Data", for every api calls of "price" section;
	4. Cryptocompare "Top list Data", gateway for every api calls of "top list" section;
- For Coinmarketcap it is only an available gateway, through which it is possible to execute every type of request.

Usage
------------
To use the package simply get the Cryptocurrencies API Manager instance from the container.
Get the choosen Gateway based on type of query you want to do, for example to "get price of BTC in fiat currencies" use the Cryptocompare "Price Data".
Use the gateway methods with right parameters to query the api.
For example:

```php
namespace App\Http\Controllers;

use IlCleme\Cryptocurrencies\Gateways\Cryptocompare\CryptocomparePriceGateway;

class CryptoController extends Controller
{
    public function getBTCPrice()
    {
        $manager = app('cryptocurrencies.manager');
        /** @var CryptocomparePriceGateway $priceGateway */
        $priceGateway = $manager->getGateway('price');

        //parameters passed to the method are defined in accordance with the Cryptocompare documentation of endpoint
        $parameters = [
            'fsym' => 'BTC',
            'tsyms' => 'USD,JPY,EUR'
        ];
        $result = $priceGateway->getSingleSymbolPrice($parameters);
        return $result;
    }
}
```
set a route for this controller and expect to receive a similar response: 
```json
{"USD":3887.35,"JPY":412906.65,"EUR":3399.46}
```

To use Coinmarketcap gateway is the same way:

```php
namespace App\Http\Controllers;

use IlCleme\Cryptocurrencies\Gateways\Coinmarketcap\CoinmarketcapGateway;

class CryptoController extends Controller
{
    public function test()
    {
        $manager = app('cryptocurrencies.manager');
        /** @var CoinmarketcapGateway $coinmarketcapGateway */
        $coinmarketcapGateway = $manager->getGateway('coinmarketcap');

        //parameters passed to the method are defined in accordance with the Coinmarketcap documentation of endpoint
        $parameters = [
            'query' => ['id' => '1,2']
        ];
        $result = $coinmarketcapGateway->send('/v1/cryptocurrency/info', 'GET', $parameters);
        return $result;
    }
}
```
Response expected:
```json
{ "status": { "timestamp": "2019-01-03T11:43:39.871Z", "error_code": 0, "error_message": null, "elapsed": 4, "credit_count": 1 }, "data": { "1": { "urls": { "website": [ "https://bitcoin.org/" ], "twitter": [], "reddit": [ "https://reddit.com/r/bitcoin" ], "message_board": [ "https://bitcointalk.org" ], "announcement": [], "chat": [], "explorer": [ "https://blockchain.info/", "https://live.blockcypher.com/btc/", "https://blockchair.com/bitcoin/blocks" ], "source_code": [ "https://github.com/bitcoin/" ] }, "logo": "https://s2.coinmarketcap.com/static/img/coins/64x64/1.png", "id": 1, "name": "Bitcoin", "symbol": "BTC", "slug": "bitcoin", "date_added": "2013-04-28T00:00:00.000Z", "tags": [ "mineable" ], "platform": null, "category": "coin" }, "2": { "urls": { "website": [ "https://litecoin.com" ], "twitter": [ "https://twitter.com/LitecoinProject" ], "reddit": [ "https://reddit.com/r/litecoin" ], "message_board": [ "https://litecointalk.io/" ], "announcement": [ "https://bitcointalk.org/index.php?topic=47417.0" ], "chat": [ "https://telegram.me/litecoin" ], "explorer": [ "http://explorer.litecoin.net/chain/Litecoin", "https://chainz.cryptoid.info/ltc/", "https://live.blockcypher.com/ltc/" ], "source_code": [ "https://github.com/litecoin-project/litecoin" ] }, "logo": "https://s2.coinmarketcap.com/static/img/coins/64x64/2.png", "id": 2, "name": "Litecoin", "symbol": "LTC", "slug": "litecoin", "date_added": "2013-04-28T00:00:00.000Z", "tags": [ "mineable" ], "platform": null, "category": "coin" } } }
```

Gateway and API Reference
------------
Here there is [full api and gateways reference](docs/API_Cryptocompare.md) for **Cryptocompare API**

Here there is [full api and gateways reference](docs/API_Coinmarketcap.md) for **Coinmarketcap API**

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
