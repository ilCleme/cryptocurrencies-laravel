<?php

namespace IlCleme\Cryptocurrencies\Test;

use IlCleme\Cryptocurrencies\Contracts\GatewayInterface;
use IlCleme\Cryptocurrencies\Gateways\Cryptocompare\CryptocompareHistoricalGateway;

class CryptocompareHistoricalGatewayTest extends TestCase
{
    //TODO: test protected and private method of CryptocompareHistoricalGateway class
    /**
     * Check that the cryptocompare gateway is correctly instantiated
     *
     * @return void
     */
    public function testCryptocompareHistoricalGatewayInstance()
    {
        $this->assertInstanceOf(GatewayInterface::class, $this->app[CryptocompareHistoricalGateway::class]);
        $this->assertObjectHasAttribute('http', $this->app[CryptocompareHistoricalGateway::class]);
        $this->assertObjectHasAttribute('endpoint', $this->app[CryptocompareHistoricalGateway::class]);
        $this->assertObjectHasAttribute('endpointOptions', $this->app[CryptocompareHistoricalGateway::class]);
    }

    /**
     * Check success historical daily request
     * Assertion:
     * - the response body contain the "Success" message
     */
    public function testSuccessHistoricalDailyWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareHistoricalGateway::class];
        $response = $gateway->getHistoricalDaily();
        $this->assertStringContainsString("Success", $response);
    }

    /**
     * Check failed Historical Daily request with wrong set of options
     * Assertion:
     * - the response body contain the "Error" message
     */
    public function testFailedHistoricalDailyRequestWithWrongOptions()
    {
        $gateway = $this->app[CryptocompareHistoricalGateway::class];
        $response = $gateway->getHistoricalDaily(['fsym' => '', 'tsym' => '']);
        $this->assertStringContainsString("Error", $response);
    }

    /**
     * Check success historical hourly request
     * Assertion:
     * - the response body contain the "Success" message
     */
    public function testSuccessHistoricalHourlyWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareHistoricalGateway::class];
        $response = $gateway->getHistoricalHourly();
        $this->assertStringContainsString("Success", $response);
    }

    /**
     * Check failed Historical Hourly request with wrong set of options
     * Assertion:
     * - the response body contain the "Error" message
     */
    public function testFailedHistoricalHourlyRequestWithWrongOptions()
    {
        $gateway = $this->app[CryptocompareHistoricalGateway::class];
        $response = $gateway->getHistoricalHourly(['fsym' => 'AAAAAA', 'tsym' => 'USD,EUR']);
        $this->assertStringContainsString("Error", $response);
    }

    /**
     * Check success historical minute request
     * Assertion:
     * - the response body contain the "Success" message
     */
    public function testSuccessHistoricalMinuteWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareHistoricalGateway::class];
        $response = $gateway->getHistoricalMinute();
        $this->assertStringContainsString("Success", $response);
    }

    /**
     * Check failed Historical minute request with wrong set of options
     * Assertion:
     * - the response body contain the "Error" message
     */
    public function testFailedHistoricalMinuteRequestWithWrongOptions()
    {
        $gateway = $this->app[CryptocompareHistoricalGateway::class];
        $response = $gateway->getHistoricalMinute(['fsym' => 'AAAAAA', 'tsym' => 'USD,EUR']);
        $this->assertStringContainsString("Error", $response);
    }

    /**
     * Check success historical daily timestamp request
     * Assertion:
     * - the response body contain the "converted" currency data
     */
    public function testSuccessHistoricalDailyTimestampWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareHistoricalGateway::class];
        $response = $gateway->getHistoricalDailyForTimestamp();
        $content = json_decode($response, true);
        $config = explode(",", config('cryptocurrencies.cryptocompare.fsym'));

        array_filter($content, function ($key) use ($config) {
            $this->assertContains($key, $config);
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Check failed historical daily timestamp request with wrong set of options
     * Assertion:
     * - the response body contain the "Error" message
     */
    public function testFailedHistoricalDailyTimestampRequestWithWrongOptions()
    {
        $gateway = $this->app[CryptocompareHistoricalGateway::class];
        $response = $gateway->getHistoricalDailyForTimestamp(['fsym' => '', 'tsym' => '']);
        $this->assertStringContainsString("Error", $response);
    }

    /**
     * Check success day average request
     * Assertion:
     * - the response body NOT contain the "Error" message
     */
    public function testSuccessHistoricalDayAverageRequestWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareHistoricalGateway::class];
        $response = $gateway->getHistoricalDayAveragePrice();
        $this->assertStringNotContainsString("Error", $response);
    }

    /**
     * Check failed day average request with wrong set of options
     * Assertion:
     * - the response body contain the "Error" message
     */
    public function testFailedHistoricalDayAverageRequestWithWrongOptions()
    {
        $gateway = $this->app[CryptocompareHistoricalGateway::class];
        $response = $gateway->getHistoricalDayAveragePrice(['fsym' => '', 'tsym' => '']);
        $this->assertStringContainsString("Error", $response);
    }

    /**
     * Check success historical daily exchange volume request
     * Assertion:
     * - the response body NOT contain the "Error" message
     */
    public function testSuccessHistoricalDailyExchangeVolumeRequestWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareHistoricalGateway::class];
        $response = $gateway->getHistoricalDailyExchangeVolume();
        $this->assertStringNotContainsString("Error", $response);
    }

    /**
     * Check failed historical daily exchange volume request with wrong set of options
     * Assertion:
     * - the response body contain the "Error" message
     */
    public function testFailedHistoricalDailyExchangeVolumeRequestWithWrongOptions()
    {
        $gateway = $this->app[CryptocompareHistoricalGateway::class];
        $response = $gateway->getHistoricalDailyExchangeVolume(['fsym' => '', 'tsym' => '']);
        $this->assertStringContainsString("Error", $response);
    }

    /**
     * Check success historical hourly exchange volume request
     * Assertion:
     * - the response body NOT contain the "Error" message
     */
    public function testSuccessHistoricalHourlyExchangeVolumeRequestWithDefaultOptions()
    {
        $gateway = $this->app[CryptocompareHistoricalGateway::class];
        $response = $gateway->getHistoricalHourlyExchangeVolume();
        $this->assertStringNotContainsString("Error", $response);
    }

    /**
     * Check failed historical hourly exchange volume request with wrong set of options
     * Assertion:
     * - the response body contain the "Error" message
     */
    public function testFailedHistoricalHourlyExchangeVolumeRequestWithWrongOptions()
    {
        $gateway = $this->app[CryptocompareHistoricalGateway::class];
        $response = $gateway->getHistoricalHourlyExchangeVolume(['fsym' => '', 'tsym' => '']);
        $this->assertStringContainsString("Error", $response);
    }
}
