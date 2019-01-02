<?php

namespace IlCleme\Cryptocurrencies\Test;

use IlCleme\Cryptocurrencies\Contracts\CryptcompareManager;
use IlCleme\Cryptocurrencies\Contracts\GatewayInterface;

class CryptocompareManagerTest extends TestCase
{
    public function testIsManagerAliasSuccessfullySet()
    {
        $manager = $this->app['cryptocurrencies.manager'];
        $this->assertInstanceOf(CryptcompareManager::class, $manager);
    }

    public function testManagerHaveGatewaysSet()
    {
        $manager = $this->app['cryptocurrencies.manager'];
        $gateways = $manager->getGateways();
        $this->assertIsArray($gateways->toArray());
    }

    public function testEveryRegisterdGatewayIsInstanceOfGatewayInterface()
    {
        $manager = $this->app['cryptocurrencies.manager'];
        $gateways = $manager->getGateways();
        $gateways->filter(function ($gateway){
            $this->assertInstanceOf(GatewayInterface::class, $gateway);
        });
    }
}
