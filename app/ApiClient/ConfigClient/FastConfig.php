<?php

namespace App\ApiClient\ConfigClient;

use App\ApiClient\Requests\FastApiRequest;
use App\ApiClient\Responses\FastApiResponse;

class FastConfig extends BaseConfig implements ConfigInterface 
{
    protected $services = [
        'FastDeliveryService' => [
            'request' => FastApiRequest::class,
            'response' => FastApiResponse::class,
        ]
    ];
}