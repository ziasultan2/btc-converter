<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class HomeService
{
	public function getBitcoinInfo($request)
	{
		$currentPrice = $this->getCurrentPrice($request);
		$minAndMaxPrice = $this->getMinAndMaxPrice($request);

		return response()->json(['current_price' => $currentPrice, 'min' => $minAndMaxPrice['min'], 'max' => $minAndMaxPrice['max']]);
	}

	public function getCurrentPrice($request)
	{
		$res  = Http::get('https://api.coindesk.com/v1/bpi/currentprice.json');
		$data = $res->json()['bpi'];
		switch ($request->currency) {
			case 'usd':
				return $data['USD']['rate_float'];
				break;
			case 'eur':
				return $data['EUR']['rate_float'];
				break;
			case 'gbp':
				return $data['GBP']['rate_float'];
				break;
			default:
				return response()->json(['error' => 'Invalid currency']);
				break;
		}
	}

	public function getMinAndMaxPrice($request)
	{
		$start = now()->toDateString('Y-m-d');
		$end = now()->subDays(30)->toDateString('Y-m-d');
		$res  = Http::get('https://api.coindesk.com/v1/bpi/historical/close.json?start='.$end.'&end='.$start.'&currency='.$request->currency);
		$data = $res->json();
		$list = array();
		foreach ($data['bpi'] as $key => $value) {
			array_push($list, $value);
		}
		$min = min($list);
		$max = max($list);
		return ['min' => $min, 'max' => $max];
	}
}