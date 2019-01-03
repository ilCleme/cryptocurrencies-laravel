API Reference for Coinmarketcap
------------
At the current status this gateway permit to send request to coinmarketcap.
The send method of this gateway permits to pass three parameters: 
- the endpoint;
- the method of HTTP request;
- an array of parameters, all parameter to be send trough the query string need to be insert in 'query' index of array;

The parameter array need to be populate with the right value for every single endpoints.
Here there is an example

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
**Coinmarketcap required an API key to receive the data**
 
TODO List 
---------

- [ ] Implementing method to send requests, one for every single endpoint
- [ ] Add caching functionality for request as Coinmarketcap guide suggests
