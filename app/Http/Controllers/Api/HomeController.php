<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\HomeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\HomeRequest;

class HomeController extends Controller
{
    public function index(HomeRequest $request)
    {
        $home = new HomeService();
        return $home->getBitcoinInfo($request);
    }
}
