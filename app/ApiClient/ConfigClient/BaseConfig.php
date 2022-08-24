<?php

namespace App\ApiClient\ConfigClient;

abstract class BaseConfig implements ConfigInterface
{
    public function getConfig(): array
    {
        return $this->services;
    }
}