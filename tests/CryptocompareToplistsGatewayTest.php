<?php

namespace IlCleme\Cryptocurrencies\Test;

use IlCleme\Cryptocurrencies\Contracts\GatewayInterface;
use IlCleme\Cryptocurrencies\Gateways\Cryptocompare\CryptocompareTopListsGateway;

class CryptocompareToplistsGatewayTest extends TestCase
{
    //TODO: test protected and private method of CryptocompareTopListsGateway class
    /**
     * Check that the cryptocompare gateway is correctly instantiated
     * @return void
     */
    public function testCryptocompareTopListsGatewayInstance()
    {
        $this->assertInstanceOf(GatewayInterface::class, $this->app[CryptocompareTopListsGateway::class]);
        $this->assertObjectHasAttribute('http', $this->app[CryptocompareTopListsGateway::class]);
        $this->assertObjectHasAttribute('endpoint', $this->app[CryptocompareTopListsGateway::class]);
        $this->assertObjectHasAttribute('endpointOptions', $this->app[CryptocompareTopListsGateway::class]);
    }

    /**
     * Check success Toplist Volume Full Data request
     * Assertion:
     * - the response body contain the "Success" message
     */
    public function testSuccessToplistVolumeFullDataRequestWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareTopListsGateway::class];
        $response = $gateway->getToplistVolumeFullData();
        $this->assertStringContainsString("Success", $response);
    }

    /**
     * Check failed Toplist Volume Full Data request with wrong set of options
     * Assertion:
     * - the response body contain the "Error" message
     */
    public function testFailedToplistVolumeFullDataRequestWithWrongOptions()
    {
        $gateway = $this->app[CryptocompareTopListsGateway::class];
        $response = $gateway->getToplistVolumeFullData(['tsym' => '']);
        $this->assertStringContainsString("Error", $response);
    }

    /**
     * Check success Toplist Market Cap Full Data request
     * Assertion:
     * - the response body contain the "Success" message
     */
    public function testSuccessToplistMarketCapFullDataRequestWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareTopListsGateway::class];
        $response = $gateway->getToplistMarketCapFullData();
        $this->assertStringContainsString("Success", $response);
    }

    /**
     * Check failed Toplist Market Cap Full Data request with wrong set of options
     * Assertion:
     * - the response body contain the "Error" message
     */
    public function testFailedToplistMarketCapFullDataRequestWithWrongOptions()
    {
        $gateway = $this->app[CryptocompareTopListsGateway::class];
        $response = $gateway->getToplistMarketCapFullData(['tsym' => '']);
        $this->assertStringContainsString("Error", $response);
    }

    /**
     * Check success top exchanges by volume for a currency pair request
     * Assertion:
     * - the response body contain the "Success" message
     */
    public function testSuccessTopExchangesVolumeDataPairRequestWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareTopListsGateway::class];
        $response = $gateway->getTopExchangesVolumeDataPair();
        $this->assertStringContainsString("Success", $response);
    }

    /**
     * Check failed top exchanges by volume for a currency pair request with wrong set of options
     * Assertion:
     * - the response body contain the "Error" message
     */
    public function testFailedTopExchangesVolumeDataPairRequestWithWrongOptions()
    {
        $gateway = $this->app[CryptocompareTopListsGateway::class];
        $response = $gateway->getTopExchangesVolumeDataPair(['tsym' => '', 'fsym' => '']);
        $this->assertStringContainsString("Error", $response);
    }

    /**
     * Check success top coins by volume for the to currency request
     * Assertion:
     * - the response body contain the "Success" message
     */
    public function testSuccessTopExchangesFullDataPairRequestWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareTopListsGateway::class];
        $response = $gateway->getTopExchangesFullDataPair();
        $this->assertStringContainsString("Success", $response);
    }

    /**
     * Check failed top coins by volume for the to currency request with wrong set of options
     * Assertion:
     * - the response body contain the "Error" message
     */
    public function testFailedTopExchangesFullDataPairRequestWithWrongOptions()
    {
        $gateway = $this->app[CryptocompareTopListsGateway::class];
        $response = $gateway->getTopExchangesFullDataPair(['tsym' => '', 'fsym' => '']);
        $this->assertStringContainsString("Error", $response);
    }

    /**
     * Check success top coins by pair for the to currency request
     * Assertion:
     * - the response body contain the "Success" message
     */
    public function testSuccessToplistPairVolumeRequestWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareTopListsGateway::class];
        $response = $gateway->getToplistPairVolume();
        $this->assertStringContainsString("Success", $response);
    }

    /**
     * Check failed top coins by volume for the to currency request with wrong set of options
     * Assertion:
     * - the response body contain the "Error" message
     */
    public function testFailedToplistPairVolumeRequestWithWrongOptions()
    {
        $gateway = $this->app[CryptocompareTopListsGateway::class];
        $response = $gateway->getToplistPairVolume(['tsym' => '']);
        $this->assertStringContainsString("Error", $response);
    }

    /**
     * Check success top pairs by volume for a currency request
     * Assertion:
     * - the response body contain the "Success" message
     */
    public function testSuccessToplistTradingPairsRequestWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareTopListsGateway::class];
        $response = $gateway->getToplistTradingPairs();
        $this->assertStringContainsString("Success", $response);
    }

    /**
     * Check failed top pairs by volume for a currency request with wrong set of options
     * Assertion:
     * - the response body contain the "Error" message
     */
    public function testFailedToplistTradingPairsRequestWithWrongOptions()
    {
        $gateway = $this->app[CryptocompareTopListsGateway::class];
        $response = $gateway->getToplistTradingPairs(['fsym' => '']);
        $this->assertStringContainsString("Error", $response);
    }
}
