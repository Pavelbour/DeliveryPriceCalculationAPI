<?php

namespace App\ApiClient\ConfigClient;

use App\ApiClient\Requests\FastApiRequest;
use App\ApiClient\Requests\SlowApiRequest;
use App\ApiClient\Responses\FastApiResponseMaper;
use App\ApiClient\Responses\SlowApiResponseMaper;

class AllServicesConfig extends BaseConfig implements ConfigInterface 
{
    protected $services = [
        'SlowDeliveryService' => [
            'request' => SlowApiRequest::class,
            'response' => SlowApiResponseMaper::class,
        ],
        'FastDeliveryService' => [
            'request' => FastApiRequest::class,
            'response' => FastApiResponseMaper::class,
        ]
    ];
}