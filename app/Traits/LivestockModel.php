<?php

namespace App\Traits;
// app/Traits/LivestockModel.php

use Illuminate\Support\Facades\Http;

trait LivestockModel
{
    function diagoniseLivestock($data)
    {
        try {
            $modelUrl = env('MODEL_URL');
            $endpoint = $modelUrl . '/diagnose';
            $response = Http::post($endpoint, $data);

            if ($response->successful()) {

                return $response->json();
            } else {
                return [
                    'error' => 'Request failed',
                    'status' => $response->status(),
                    'body' => $response->body()
                ];
            }
        } catch (\Exception $e) {
            return [
                'error' => 'Exception occurred',
                'message' => $e->getMessage()
            ];
        }
    }
}
