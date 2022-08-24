<?php

namespace App\ApiClient;

use App\ApiClient\ConfigClient\ConfigInterface;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

class ApiClient
{
    private array $config = [];

    public function __construct(ConfigInterface $config)
    {
        $this->config = $config->getConfig();
    }

    public function doRequest(): array
    {
        $responses = Http::pool(function (Pool $pool) {
            $services = [];
            foreach ($this->config as $name => $service) {
                $request = new $service['request'];
                $services[] = $pool->as($name)->post($request->getEndpoint(), $request->getPostParams());
            }

            return $services;
        });

        $result = [];

        foreach ($this->config as $name => $service) {
            $response = new $service['response'];
            $result[] = $response->processResponse($name, $responses[$name]);
        }

        return $result;
    }
}