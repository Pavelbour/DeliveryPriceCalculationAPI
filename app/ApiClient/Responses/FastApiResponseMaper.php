<?php

namespace App\ApiClient\Responses;

use Illuminate\Http\Client\Response;

class FastApiResponseMaper implements MaperInterface
{
    public function processResponse(string $name, Response $response): DeliveryServiceData
    {
        if ($response->ok()) {
            $json = $response->json();
            $price = 150 * $json['coefficient'];
            return new DeliveryServiceData(
                false,
                $name,
                $price,
                $json['date']
            );
        }

        return new DeliveryServiceData(true);
    }
}