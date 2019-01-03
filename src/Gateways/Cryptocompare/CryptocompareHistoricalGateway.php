<?php

namespace IlCleme\Cryptocurrencies\Gateways\Cryptocompare;

use GuzzleHttp\Client;

class CryptocompareHistoricalGateway extends CryptocompareGateway
{
    protected $name = 'historical';

    public function __construct(Client $http)
    {
        parent::__construct($http);

        $this->endpointOptions = [
            'fsym' => config('cryptocurrencies.cryptocompare.fsym'),
            'tsym' => config('cryptocurrencies.cryptocompare.tsym'),
            'tsyms' => config('cryptocurrencies.cryptocompare.tsym'),
            //TODO: improve manage of tsyms and tsym query parameter
            'extraParams' => config('cryptocurrencies.cryptocompare.extraParams'),
        ];
    }

    /**
     * Get open, high, low, close, volumefrom and volumeto from the daily historical data.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getHistoricalDaily($options = [])
    {
        return $this->send(
            $this->endpoint."/histoday",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Get open, high, low, close, volumefrom and volumeto from the hourly historical data.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getHistoricalHourly($options = [])
    {
        return $this->send(
            $this->endpoint."/histohour",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Get open, high, low, close, volumefrom and volumeto from the each minute historical data.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getHistoricalMinute($options = [])
    {
        return $this->send(
            $this->endpoint."/histominute",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Get the price of any cryptocurrency in any other currency that you need at a given timestamp.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getHistoricalDailyForTimestamp($options = [])
    {
        return $this->send(
            $this->endpoint."/pricehistorical",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Get day average price.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getHistoricalDayAveragePrice($options = [])
    {
        return $this->send(
            $this->endpoint."/dayAvg",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Get total volume from the daily historical exchange data.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getHistoricalDailyExchangeVolume($options = [])
    {
        return $this->send(
            $this->endpoint."/exchange/histoday",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Get total volume from the hourly historical exchange data.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getHistoricalHourlyExchangeVolume($options = [])
    {
        return $this->send(
            $this->endpoint."/exchange/histohour",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }
}
