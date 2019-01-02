<?php

namespace IlCleme\Cryptocurrencies\Contracts;

interface GatewayInterface
{
    /**
     * Send an HTTP request
     *
     * @param $endpoint string Request destination
     * @param string $method HTTP Method
     * @param array $options Request options
     * @return mixed
     */
    public function send($endpoint, $method = 'GET', $options = [] );

    /**
     * Return name of gateway
     *
     * @return mixed
     */
    public function getName();

    /**
     * Set name of gateway
     *
     * @param $name
     * @return void
     */
    public function setName($name);
}
