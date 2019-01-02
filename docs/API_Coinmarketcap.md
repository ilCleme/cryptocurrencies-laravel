API Reference for Coinmarketcap
------------
In this time this gateway permit to send request to coinmarketcap.
The send method of this gateway permits to pass three parameters: 
- the endpoint;
- the method of HTTP request;
- an array of parameters, all parameter to be send trough the query string need to be insert in 'query' index of array;

The parameter array need to be populate with the right value for every single endpoints.
Here there is an example

```php
   $manager = $this->app['cryptocurrencies.manager'];
   $coinmarketcapGateway = $manager->getGateway('coinmarketcap');
   //set any type of endpoints, set the right parameter to it
   $result = $coinmarketcapGateway->send('/v1/cryptocurrency/info', 'GET', ['query' => ['id' => '1,2']]);

   return $result;
```
**Coinmarketcap required an API key to receive the data**
 
TODO List 
---------

- [ ] Implementing method to send requests, one for every single endpoint
- [ ] Add caching functionality for request as Coinmarketcap guide suggests
