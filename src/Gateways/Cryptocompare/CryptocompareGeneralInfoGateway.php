<?php

namespace IlCleme\Cryptocurrencies\Gateways\Cryptocompare;

use GuzzleHttp\Client;

class CryptocompareGeneralInfoGateway extends CryptocompareGateway
{
    protected $name = 'general';

    public function __construct(Client $http)
    {
        parent::__construct($http);

        $this->endpointOptions = [
            'extraParams' => config('cryptocurrencies.cryptocompare.extraParams'),
            'api_key' => config('cryptocurrencies.cryptocompare.api_key'),
        ];
        $this->endpoint = 'https://min-api.cryptocompare.com';
    }

    /**
     * Find out how many calls you have left in the current month, day, hour, minute and second
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getRateLimit($options = [])
    {
        return $this->send(
            $this->endpoint."/stats/rate/limit",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Returns all the exchanges that CryptoCompare has integrated with.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getAllExchangesAndTradingPairs($options = [])
    {
        return $this->send(
            $this->endpoint."/data/v2/all/exchanges",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Returns all the coins that CryptoCompare has added to the website.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getAllCoins($options = [])
    {
        return $this->send(
            $this->endpoint."/data/all/coinlist",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Returns general info about all the exchanges we have integarted with.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getAllExchangeGeneralInfo($options = [])
    {
        return $this->send(
            $this->endpoint."/data/exchanges/general",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Returns general info about all the wallets we have integarted with.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getAllWalletGeneralInfo($options = [])
    {
        return $this->send(
            $this->endpoint."/data/wallets/general",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Returns general info about all the crypto cards we have integarted with.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getAllCryptoCardGeneralInfo($options = [])
    {
        return $this->send(
            $this->endpoint."/data/cards/general",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }
}
