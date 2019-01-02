<?php

namespace IlCleme\Cryptocurrencies\Test;

use IlCleme\Cryptocurrencies\Contracts\GatewayInterface;
use IlCleme\Cryptocurrencies\Gateways\Cryptocompare\CryptocomparePriceGateway;

class CryptocomparePriceGatewayTest extends TestCase
{
    //TODO: test protected and private method of CryptocomparePriceGateway class
    /**
     * Check that the cryptocompare gateway is correctly instantiated
     * @return void
     */
    public function testCryptocomparePriceGatewayInstance()
    {
        $this->assertInstanceOf(GatewayInterface::class, $this->app[CryptocomparePriceGateway::class]);
        $this->assertObjectHasAttribute('http', $this->app[CryptocomparePriceGateway::class]);
        $this->assertObjectHasAttribute('endpoint', $this->app[CryptocomparePriceGateway::class]);
        $this->assertObjectHasAttribute('endpointOptions', $this->app[CryptocomparePriceGateway::class]);
    }

    /**
     * Check success Single symbol price request
     * Assertion:
     * - the response body contain the "converted" currency data
     */
    public function testSuccessSingleSymbolPriceRequestWithDefaultOptions()
    {
        $gateway = $this->app[CryptocomparePriceGateway::class];
        $response = $gateway->getSingleSymbolPrice();
        $content = json_decode($response, true);
        $config = explode("," , config('cryptocurrencies.cryptocompare.tsym'));

        array_filter($content, function($key) use ($config){
            $this->assertContains($key, $config);
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Check failed single symbol price request with wrong set of options
     * Assertion:
     * - the response body contain the "Error" message
     */
    public function testFailedSingleSymbolPriceRequestWithWrongOptions()
    {
        $gateway = $this->app[CryptocomparePriceGateway::class];
        $response = $gateway->getSingleSymbolPrice(['fsyms' => 'AAAAAA', 'tsyms' => 'AAAAA']);
        $this->assertStringContainsString("Error", $response);
    }

    /**
     * Check success Multiple symbol price request
     * Assertion:
     * - the response body contain an array with keys equal to the requested currency (fsyms parameter)
     */
    public function testSuccessMultiSymbolPriceRequestWithDefaultOptions()
    {
        $gateway = $this->app[CryptocomparePriceGateway::class];
        $fsyms = ['fsyms' => 'BTC,ETH'];
        $response = $gateway->getMultiSymbolPrice($fsyms);
        $content = json_decode($response, true);
        $config = explode(',', array_get($fsyms, 'fsyms'));

        array_filter($content, function($value, $key) use ($config){
            $this->assertContains($key,$config);
        }, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * Check failed multiple symbol price request with wrong set of options
     * Assertion:
     * - the response body contain the "Error" message
     */
    public function testFailedMultiSymbolPriceRequestWithWrongOptions()
    {
        $gateway = $this->app[CryptocomparePriceGateway::class];
        $fsyms = ['fsyms' => ''];
        $response = $gateway->getMultiSymbolPrice($fsyms);
        $this->assertStringContainsString("Error", $response);
    }

    /**
     * Check success full multiple symbol price request
     * Assertion:
     * - the response body contain an array with keys equal to "RAW" and "DISPLAY"
     */
    public function testSuccessMultiSymbolPriceFullRequestWithDefaultOptions()
    {
        $gateway = $this->app[CryptocomparePriceGateway::class];
        $fsyms = ['fsyms' => 'BTC,ETH'];
        $response = $gateway->getMultiSymbolPriceFull($fsyms);
        $content = json_decode($response, true);
        $keysResponse = ['RAW', 'DISPLAY'];

        array_filter($content, function($value, $key) use ($keysResponse){
            $this->assertContains($key,$keysResponse);
        }, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * Check failed full multiple symbol price request  with wrong set of options
     * Assertion:
     * - the response body contain the "Error" message
     */
    public function testFailedMultiSymbolPriceFullRequestWithWrongOptions()
    {
        $gateway = $this->app[CryptocomparePriceGateway::class];
        $fsyms = ['fsyms' => ''];
        $response = $gateway->getMultiSymbolPrice($fsyms);
        $this->assertStringContainsString("Error", $response);
    }

    /**
     * Check success Custom Average price request
     * Assertion:
     * - the response body contain an array with keys equal to "RAW" and "DISPLAY"
     */
    public function testSuccessCustomAverageRequestWithDefaultOptions()
    {
        $gateway = $this->app[CryptocomparePriceGateway::class];
        $fsyms = ['fsym' => 'BTC', 'tsym' => 'EUR'];
        $response = $gateway->getCustomAverage($fsyms);
        $content = json_decode($response, true);
        $keysResponse = ['RAW', 'DISPLAY'];

        array_filter($content, function($value, $key) use ($keysResponse){
            $this->assertContains($key,$keysResponse);
        }, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * Check failed Custom Average price request  with wrong set of options
     * Assertion:
     * - the response body contain the "Error" message
     */
    public function testFailedCustomAverageRequestWithWrongOptions()
    {
        $gateway = $this->app[CryptocomparePriceGateway::class];
        $fsyms = ['fsym' => 'BTC,ETH'];
        $response = $gateway->getCustomAverage($fsyms);
        $this->assertStringContainsString("Error", $response);
    }
}
