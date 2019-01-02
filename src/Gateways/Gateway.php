<?php

namespace IlCleme\Cryptocurrencies\Gateways;

use GuzzleHttp\Client;
use IlCleme\Cryptocurrencies\Contracts\GatewayInterface;
use IlCleme\Cryptocurrencies\Contracts\HTTP;
use IlCleme\Cryptocurrencies\Contracts\Request;

abstract class Gateway implements GatewayInterface
{
    /**
     * @var Client http
     */
    protected $http;

    public function __construct(Client $http)
    {
        $this->http = $http;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function send($endpoint, $method = 'GET', $options = []);

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
