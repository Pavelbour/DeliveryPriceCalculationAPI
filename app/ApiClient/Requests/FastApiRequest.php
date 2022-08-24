<?php

namespace App\ApiClient\Requests;

use Illuminate\Http\Request;

class FastApiRequest extends BaseRequest
{
    public function __construct()
    {
        // $this->endpoint = 'dpc-nginx/api/fast-delivery';
        $this->endpoint = env('FAST_API_URL');
        $this->serviceName = 'SlowDeliveryService';
        $request = resolve(Request::class);
        $this->params['source'] = $request['source'];
        $this->params['target'] = $request['target'];
        $this->params['weight'] = $request['weight'];
    }
}