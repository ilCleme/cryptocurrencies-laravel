<?php
/**
 * Created by PhpStorm.
 * User: mattiaclementi
 * Date: 31/12/2018
 * Time: 11:08
 */

namespace IlCleme\Cryptocurrencies\Gateways\Coinmarketcap;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use IlCleme\Cryptocurrencies\Gateways\Gateway;

//TODO: create specific method for every coinmarketcap endpoint o permit custom cache time per request
class CoinmarketcapGateway extends Gateway
{
    /** @var string Public endpoint for coinmarketcap platform */
    protected $endpoint = '';

    /** @var $name string Name of gateway */
    protected $name = 'coinmarketcap';

    public function __construct(Client $http)
    {
        parent::__construct($http);

        $this->endpoint = config('cryptocurrencies.coinmarketcap.sandbox_mode') ?
            config('cryptocurrencies.coinmarketcap.sandbox_url') :
            config('cryptocurrencies.coinmarketcap.production_url');
    }

    /**
     * {@inheritdoc}
     * TODO: Cache response body as suggested by coinmarketcap
     */
    public function send($endpoint, $method = 'GET', $options = [])
    {
        if (!array_get($options, 'headers.X-CMC_PRO_API_KEY')){
            $options = array_merge($options, ['headers' => ['X-CMC_PRO_API_KEY' => config('cryptocurrencies.coinmarketcap.api_key')]]);
        }

        try {
            $response = $this->http->request($method, $this->endpoint . $endpoint, $options);
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
        }
        return $response->getBody()->getContents();
    }

}
