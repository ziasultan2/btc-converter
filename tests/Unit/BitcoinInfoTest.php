<?php

namespace Tests\Unit;

use App\Http\Services\HomeService;
use Tests\TestCase;

class BitcoinInfoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_todays_bitcoin_price()
    {
       $this->assertTrue(true);

        $btc = new HomeService();
        $data = $btc->getCurrentPrice('usd');
        $this->assertIsFloat($data, 'Todays bitcoin price in float');
    }

    public function test_last_30_days_min_max_price()
    {
        $btc = new HomeService();
        $data = $btc->getMinAndMaxPrice('usd');
        $this->assertTrue($data['min'] && $data['max'], 'Min and Max price in last 30 days');
    }
}
