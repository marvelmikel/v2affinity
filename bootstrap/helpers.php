<?php

/*
|--------------------------------------------------------------------------
| Helpers.php Function File
|--------------------------------------------------------------------------
|
| Custom PHP functions for global use
|
*/

use Illuminate\Support\Facades\Http;

// Get API token
function getToken()
{
    // Check if token is cached and expiry is definitely in the future
    if(Cache::has('api_token') && Cache::get('api_token_expiry') > date('Y-m-d H:i:s') ){

        // Return API token
        return Cache::get('api_token');

        // Else generate new token
    } else {

        // Request new token
        $response = Http::asForm()->post(env('API_URL').'oauth/token', [
            'grant_type' => 'client_credentials',
            'client_id' => env('API_CLIENT'),
            'client_secret' => env('API_SECRET')
        ]);

        $response = $response->json();

        // Save in cache
        Cache::put('api_token', $response['access_token'], $response['expires_in']);
        Cache::put('api_token_expiry', date("Y-m-d H:i:s", strtotime("+".$response['expires_in']." sec")));

        // Return API token
        return $response['access_token'];

    }
}

// Connect to affinity app API
function apiCall( $url, $type = 'GET', $content = false)
{
    $response = Http::withToken(getToken())
        ->send($type, env('API_URL').'api/'.$url, [
            'json' => $content,
            'Content-Type' => 'application/json'
        ]);

    return $response->json();
}
