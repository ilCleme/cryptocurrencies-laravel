<?php

namespace IlCleme\Cryptocurrencies\Gateways\Cryptocompare;

use GuzzleHttp\Client;

class CryptocomparePriceGateway extends CryptocompareGateway
{
    protected $name = 'price';

    /**
     * CryptocomparePriceGateway constructor.
     *
     * @param Client $http
     */
    public function __construct(Client $http)
    {
        parent::__construct($http);

        $this->endpointOptions = [
            'fsym' => config('cryptocurrencies.cryptocompare.fsym'),
            'fsyms' => config('cryptocurrencies.cryptocompare.fsym'),
            //TODO: improve manage of fsyms and fsym query parameter
            'tsym' => config('cryptocurrencies.cryptocompare.tsym'),
            'tsyms' => config('cryptocurrencies.cryptocompare.tsym'),
            //TODO: improve manage of tsyms and tsym query parameter
            'e' => config('cryptocurrencies.cryptocompare.e'),
            'extraParams' => config('cryptocurrencies.cryptocompare.extraParams'),
        ];
    }

    /**
     * Get the current price of single cryptocurrency in any other currency that you need.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getSingleSymbolPrice($options = [])
    {
        return $this->send(
            $this->endpoint."/price",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Get the current price of multiple cryptocurrency in any other currency that you need.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getMultiSymbolPrice($options = [])
    {
        return $this->send(
            $this->endpoint."/pricemulti",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Get the current price of multiple cryptocurrency in any other currency that you need.
     * Retrive every founded data for currencies specify as fromS
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getMultiSymbolPriceFull($options = [])
    {
        return $this->send(
            $this->endpoint."/pricemultifull",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }

    /**
     * Compute the current trading info (price, vol, open, high, low etc) of the
     * requested pair as a volume weighted average based on the exchanges requested.
     *
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getCustomAverage($options = [])
    {
        return $this->send(
            $this->endpoint."/generateAvg",
            'GET',
            ['query' => array_merge($this->getEndpointConfiguration(), $options)]
        );
    }
}
