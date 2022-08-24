<?php

namespace App\ApiClient\ConfigClient;

use App\ApiClient\Requests\FastApiRequest;
use App\ApiClient\Requests\SlowApiRequest;
use App\ApiClient\Responses\FastApiResponse;
use App\ApiClient\Responses\SlowApiResponse;

class AllServicesConfig extends BaseConfig implements ConfigInterface 
{
    protected $services = [
        'SlowDeliveryService' => [
            'request' => SlowApiRequest::class,
            'response' => SlowApiResponse::class,
        ],
        'FastDeliveryService' => [
            'request' => FastApiRequest::class,
            'response' => FastApiResponse::class,
        ]
    ];
}