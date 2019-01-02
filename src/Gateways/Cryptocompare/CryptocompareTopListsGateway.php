<?php

namespace IlCleme\Cryptocurrencies\Gateways\Cryptocompare;

use GuzzleHttp\Client;

class CryptocompareTopListsGateway extends CryptocompareGateway
{
    protected $name = 'toplist';

    public function __construct(Client $http)
    {
        parent::__construct($http);

        $this->endpointOptions = [
            'fsym' => config('cryptocurrencies.cryptocompare.fsym'),
            'tsym' => config('cryptocurrencies.cryptocompare.tsym'),
            'extraParams' => config('cryptocurrencies.cryptocompare.extraParams'),
        ];
    }

    /**
     * Get a number of top coins by their total volume across all markets in the last 24 hours.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getToplistVolumeFullData($options = [])
    {
        return $this->send(
            $this->endpoint . "/top/totalvolfull",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Get a number of top coins by their total volume across all markets in the last 24 hours.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getToplistMarketCapFullData($options = [])
    {
        return $this->send(
            $this->endpoint . "/top/mktcapfull",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Get top exchanges by volume for a currency pair.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getTopExchangesVolumeDataPair($options = [])
    {
        return $this->send(
            $this->endpoint . "/top/exchanges",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Get top exchanges by volume for a currency pair plus the full CCCAGG data.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getTopExchangesFullDataPair($options = [])
    {
        return $this->send(
            $this->endpoint . "/top/exchanges/full",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Get top coins by volume for the to currency.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getToplistPairVolume($options = [])
    {
        return $this->send(
            $this->endpoint . "/top/volumes",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Get top pairs by volume for a currency (always uses our aggregated data).
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getToplistTradingPairs($options = [])
    {
        return $this->send(
            $this->endpoint . "/top/pairs",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }
}
