<?php

namespace App\ApiClient\Requests;

abstract class BaseRequest
{
    protected string $endpoint;
    protected string $serviceName;
    protected array $params;

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getPostParams(): array
    {
        return $this->params;
    }

    public function getServiceName(): string
    {
        return $this->serviceName;
    }
}