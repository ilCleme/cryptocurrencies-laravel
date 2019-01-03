<?php

namespace IlCleme\Cryptocurrencies\Test;

use IlCleme\Cryptocurrencies\Contracts\GatewayInterface;
use IlCleme\Cryptocurrencies\Gateways\Coinmarketcap\CoinmarketcapGateway;

class CoinmarketcapGatewayTest extends TestCase
{
    //TODO: test protected and private method of CoinmarketcapGateway class
    /**
     * Check that the Coinmarketcap gateway is correctly instantiated
     *
     * @return void
     */
    public function testCoinmarketcapGatewayInstance()
    {
        $this->assertInstanceOf(GatewayInterface::class, $this->app[CoinmarketcapGateway::class]);
        $this->assertObjectHasAttribute('endpoint', $this->app[CoinmarketcapGateway::class]);
    }

    /**
     * Check success Rate Limit request
     * Assertion:
     * - the response body "error_code" is equal to 0
     */
    public function testSuccessSend()
    {
        $gateway = $this->app[CoinmarketcapGateway::class];
        $response = $gateway->send('/v1/cryptocurrency/info?id=1,2');
        $this->assertIsString($response);
        $response = json_decode($response, true);
        if (!config('cryptocurrencies.coinmarketcap.api_key')) {
            $this->assertEquals(401, array_get($response, 'status.error_code'));
        } else {
            $this->assertEquals(0, array_get($response, 'status.error_code'));
        }
    }

    /**
     * Check success Rate Limit request
     * Assertion:
     * - the response body "error_code" is greather than 0
     */
    public function testFailedSend()
    {
        $gateway = $this->app[CoinmarketcapGateway::class];
        $response = $gateway->send('/v1/cryptocurrency/info');
        $this->assertIsString($response);
        $response = json_decode($response, true);
        $this->assertGreaterThan(0, array_get($response, 'status.error_code'));
    }

    /**
     * Check success Rate Limit request
     * Assertion:
     * - the response body "error_code" is greather than 0
     */
    public function testFailedSendWithWrongApiKeySet()
    {
        $gateway = $this->app[CoinmarketcapGateway::class];
        $response = $gateway->send('/v1/cryptocurrency/info', 'GET', [
            'headers' => ['X-CMC_PRO_API_KEY' => 'FalsyAPIKey'],
            'query' => ['id' => '1,2'],
        ]);
        $this->assertIsString($response);
        $response = json_decode($response, true);
        $this->assertEquals(401, array_get($response, 'status.error_code'));
    }
}
