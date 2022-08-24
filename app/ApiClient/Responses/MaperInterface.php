<?php

namespace App\ApiClient\Responses;

use Illuminate\Http\Client\Response;

interface MaperInterface
{
    public function processResponse(string $name, Response $response): DeliveryServiceData;
}