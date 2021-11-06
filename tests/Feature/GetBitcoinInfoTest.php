<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetBitcoinInfoTest extends TestCase
{
    public function test_bitcoin_info_status()
    {
        $response = $this->get('/api/get-bitcoin-info?currency=usd');
        $response->assertJson([
            'success' => true,
        ]);
    }
}
