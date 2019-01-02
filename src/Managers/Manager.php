<?php

namespace IlCleme\Cryptocurrencies\Managers;

use IlCleme\Cryptocurrencies\Contracts\CryptcompareManager;
use IlCleme\Cryptocurrencies\Contracts\GatewayInterface;

class Manager implements CryptcompareManager
{
    protected $gateways;

    /**
     * Return all registred gateways
     *
     * @return mixed
     */
    public function getGateways()
    {
        if (!$this->gateways) {
            return collect([]);
        }

        return $this->gateways;
    }

    /**
     * Return some specific gateway
     *
     * @param $gateway string Identifier of gateway
     * @return mixed
     */
    public function getGateway($gateway)
    {
        if (!$this->gateways) {
            return false;
        }

        return $this->gateways->first(function($item) use ($gateway){
            if ($item->getName() == $gateway) {
                return $item;
            }

            return false;
        });
    }

    /**
     * Add new gateway
     *
     * @param GatewayInterface $gateway
     * @return mixed
     */
    public function addGateway(GatewayInterface $gateway)
    {
        if (!$this->gateways) {
            $this->gateways = collect([]);
        }

        $this->gateways->push($gateway);
    }
}
