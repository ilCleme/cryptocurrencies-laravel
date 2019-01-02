<?php

namespace IlCleme\Cryptocurrencies\Gateways\Cryptocompare;

use IlCleme\Cryptocurrencies\Gateways\Gateway;

class CryptocompareGateway extends Gateway
{
    /** @var string Public endpoint for cryptocompare platform */
    protected $endpoint = 'https://min-api.cryptocompare.com/data';

    /** @var array Contains the default options defined by cryptocompare platform */
    protected $endpointOptions = [];

    /** @var $name string Name of gateway */
    protected $name;

    /**
     * {@inheritdoc}
     */
    public function send($endpoint, $method = 'GET', $options = [])
    {
        $response = $this->http->request($method, $endpoint, $options);

        return $response->getBody()->getContents();
    }

    /**
     * Get the current options for endpoint
     *
     * @return array
     */
    protected function getEndpointConfiguration()
    {
        return $this->endpointOptions;
    }
}
