<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CalculateDeliveryPriceApiTest extends TestCase
{
    public function setUp(): void 
    {
        parent::setUp();
        Http::fake([
            env('SLOW_API_URL') => Http::response([
                    'price' => 399.99,
                    'period' => 3,
                    'error' => false
                ], 200),
            env('FAST_API_URL') => Http::response([
                'coefficient' => 2.36,
                'date' => '2022-10-03',
                'error' => false
            ], 200)
        ]);
    }

    public function test_all_services()
    {
        $response = $this->post('/calculate-delivery', [
            'source' => 'Address 1',
            'target' => 'Address 2',
            'weight' => 2.36
        ]);

        $now = Carbon::now();
        $estimatedDeliveryDate = $now->hour >= 18 ? $now->addDays(4) : $now->addDays(1);
        $estimatedDate = $estimatedDeliveryDate->format('Y-m-d');

        $response
            ->assertStatus(200)
            ->assertJson([
                [
                    'service_name' => 'SlowDeliveryService',
                    'price' => 399.99,
                    'date' => $estimatedDate,
                    'error' => false
                ],
                [
                    'service_name' => 'FastDeliveryService',
                    'price' => 354,
                    'date' => '2022-10-03',
                    'error' => false
                ]
            ]);
    }

    public function test_all_services_bad_request()
    {
            $response = $this->post('/calculate-delivery', [
                'source' => 'Address 1',
                'target' => 'Address 2'
        ]);

        $response->assertStatus(400);
    }

    public function test_slow_api_only()
    {
            $response = $this->post('/calculate-delivery/Slow', [
                'source' => 'Address 1',
                'target' => 'Address 2',
                'weight' => 2.36
        ]);

        $now = Carbon::now();
        $estimatedDeliveryDate = $now->hour >= 18 ? $now->addDays(4) : $now->addDays(1);
        $estimatedDate = $estimatedDeliveryDate->format('Y-m-d');

        $response
            ->assertStatus(200)
            ->assertJson([
                [
                    'service_name' => 'SlowDeliveryService',
                    'price' => 399.99,
                    'date' => $estimatedDate,
                    'error' => false
                ]
            ]);
    }

    public function test_fast_api_only() {
            $response = $this->post('/calculate-delivery/Fast', [
                'source' => 'Address 1',
                'target' => 'Address 2',
                'weight' => 2.36
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                [
                    'service_name' => 'FastDeliveryService',
                    'price' => 354,
                    'date' => '2022-10-03',
                    'error' => false
                ]
            ]);
    }
}