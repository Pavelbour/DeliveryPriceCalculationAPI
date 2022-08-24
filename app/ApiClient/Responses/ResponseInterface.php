<?php

namespace App\ApiClient\Responses;

use Illuminate\Http\Client\Response;

interface ResponseInterface
{
    public function processResponse(string $name, Response $response): DeliveryServiceData;
}