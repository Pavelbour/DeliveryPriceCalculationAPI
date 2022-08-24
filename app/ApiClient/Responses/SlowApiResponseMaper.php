<?php

namespace App\ApiClient\Responses;

use Carbon\Carbon;
use Illuminate\Http\Client\Response;

class SlowApiResponseMaper implements MaperInterface
{
    public function processResponse(string $name, Response $response): DeliveryServiceData
    {
        if ($response->ok()) {
            $json = $response->json();
            $now = Carbon::now();
            $estimatedDeliveryDate = $now->hour >= 18 ? $now->addDays($json['period'] + 1) : $now->addDays($json['period']);
            return new DeliveryServiceData(
                false,
                $name,
                $json['price'],
                $estimatedDeliveryDate->format('Y-m-d')
            );
        }

        return new DeliveryServiceData(true);
    }
}