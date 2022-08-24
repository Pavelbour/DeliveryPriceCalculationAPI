<?php

namespace App\ApiClient\ConfigClient;

use App\ApiClient\Requests\SlowApiRequest;
use App\ApiClient\Responses\SlowApiResponseMaper;

class SlowConfig extends BaseConfig implements ConfigInterface 
{
    protected $services = [
        'SlowDeliveryService' => [
            'request' => SlowApiRequest::class,
            'response' => SlowApiResponseMaper::class,
        ],
    ];
}