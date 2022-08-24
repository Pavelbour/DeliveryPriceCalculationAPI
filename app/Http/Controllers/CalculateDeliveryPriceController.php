<?php

namespace App\Http\Controllers;

use App\ApiClient\ApiClient;
use App\ApiClient\ConfigClient\AllServicesConfig;
use App\ApiClient\ConfigClient\ConfigInterface;
use Illuminate\Http\Request;

class CalculateDeliveryPriceController extends Controller
{
    public function calculatePrice(Request $request, AllServicesConfig $config)
    {
        return response()->json($this->doRequest($config));
    }

    public function oneService(Request $request, string $service)
    {
        if (!class_exists('App\ApiClient\ConfigClient\\' . $service . 'Config')) {
            return response("Service $service not found.", 400);
        }

        $config = new ('App\ApiClient\ConfigClient\\' . $service . 'Config');
        
        return response()->json($this->doRequest($config));
    }

    private function doRequest(ConfigInterface $config): array
    {
        $apiClient = new ApiClient($config);
        $response = $apiClient->doRequest();

        $result = [];
        foreach ($response as $service) {
            $result[] = $service->getData();
        }

        return $result;
    }
}
