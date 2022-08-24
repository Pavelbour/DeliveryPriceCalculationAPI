<?php

namespace App\ApiClient\Responses;

class DeliveryServiceData
{
    public function __construct(
        private bool $error,
        private ?string $name = null,
        private ?float $price = null,
        private ?string $date = null,
    ) {}

    public function getData(): array
    {
        return [
            'service_name' => $this->name,
            'price' => $this->price,
            'date' => $this->date,
            'error' => $this->error,
        ];
    }
}