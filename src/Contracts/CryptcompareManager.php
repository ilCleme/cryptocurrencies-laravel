<?php

namespace IlCleme\Cryptocurrencies\Contracts;

interface CryptcompareManager
{
    /**
     * Return all registred gateways
     *
     * @return mixed
     */
    public function getGateways();

    /**
     * Return some specific gateway
     *
     * @param $gateway string  Identifier of gateway
     * @return mixed
     */
    public function getGateway($gateway);

    /**
     * Add new gateway
     *
     * @param GatewayInterface $gateway
     * @return mixed
     */
    public function addGateway(GatewayInterface $gateway);
}
