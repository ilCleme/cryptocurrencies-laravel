<?php

namespace IlCleme\Cryptocurrencies\Test;

use IlCleme\Cryptocurrencies\Contracts\GatewayInterface;
use IlCleme\Cryptocurrencies\Gateways\Cryptocompare\CryptocompareGeneralInfoGateway;

class CryptocompareGeneralInfoGatewayTest extends TestCase
{
    //TODO: test protected and private method of CryptocompareGeneralInfoGateway class
    /**
     * Check that the cryptocompare gateway is correctly instantiated
     *
     * @return void
     */
    public function testCryptocompareGeneralInfoGatewayInstance()
    {
        $this->assertInstanceOf(GatewayInterface::class, $this->app[CryptocompareGeneralInfoGateway::class]);
        $this->assertObjectHasAttribute('http', $this->app[CryptocompareGeneralInfoGateway::class]);
        $this->assertObjectHasAttribute('endpoint', $this->app[CryptocompareGeneralInfoGateway::class]);
        $this->assertObjectHasAttribute('endpointOptions', $this->app[CryptocompareGeneralInfoGateway::class]);
    }

    /**
     * Check success Rate Limit request
     * Assertion:
     * - the response body contain the "Success" message
     */
    public function testSuccessRateLimitRequestWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareGeneralInfoGateway::class];
        $response = $gateway->getRateLimit();
        $this->assertStringContainsString("Success", $response);
    }

    /**
     * Check success All Exchanges And Trading Pairs request
     * Assertion:
     * - the response body contain the "Success" message
     */
    public function testSuccessAllExchangesAndTradingPairsRequestWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareGeneralInfoGateway::class];
        $response = $gateway->getAllExchangesAndTradingPairs();
        $this->assertStringContainsString("Success", $response);
    }

    /**
     * Check success all coins request
     * Assertion:
     * - the response body contain the "Success" message
     */
    public function testSuccessAllCoinsWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareGeneralInfoGateway::class];
        $response = $gateway->getAllCoins();
        $this->assertStringContainsString("Success", $response);
    }

    /**
     * Check success all exchange general info request
     * Assertion:
     * - the response body contain the "Success" message
     */
    public function testAllExchangeGeneralInfoWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareGeneralInfoGateway::class];
        $response = $gateway->getAllExchangeGeneralInfo();

        if (! empty(config('cryptocurrencies.cryptocompare.api_key'))) {
            $this->assertStringContainsString("Success", $response);
        } else {
            $this->assertStringContainsString("Error", $response);
        }
    }

    /**
     * Check success all wallet general info request
     * Assertion:
     * - the response body contain the "Success" message
     */
    public function testAllWalletGeneralInfoWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareGeneralInfoGateway::class];
        $response = $gateway->getAllWalletGeneralInfo();

        if (! empty(config('cryptocurrencies.cryptocompare.api_key'))) {
            $this->assertStringContainsString("Success", $response);
        } else {
            $this->assertStringContainsString("Error", $response);
        }
    }

    /**
     * Check success all crypto card general info request
     * Assertion:
     * - the response body contain the "Success" message
     */
    public function testAllCryptoCardGeneralInfoWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareGeneralInfoGateway::class];
        $response = $gateway->getAllCryptoCardGeneralInfo();

        if (! empty(config('cryptocurrencies.cryptocompare.api_key'))) {
            $this->assertStringContainsString("Success", $response);
        } else {
            $this->assertStringContainsString("Error", $response);
        }
    }
}
