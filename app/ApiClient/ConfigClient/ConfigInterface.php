<?php

namespace App\ApiClient\ConfigClient;

interface ConfigInterface
{
    public function getConfig(): array;
}