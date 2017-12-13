<?php

namespace App\Services;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;

class PwAuthService
{

    public function send($title, $text)
    {
        $url = 'https://api.push.world/v2/multicast/send';

        $params = [
            'headers' => [
                'Authorization' => 'Bearer ' . self::getAuthToken()->access_token,
            ],
            'form_params' => [
                'platform_code' => env('PW_PLATFORM_CODE'),
                'multicast' => json_encode([
                    "title" => $title,
                    "text" => $text,
                    "url" => "https://push.world/help/rich-push-v2",
                    "image" => "https://the-challenger.ru/wp-content/uploads/2015/06/shutterstock_115383406-800x538.jpg",
                    "image_large" => "https://push.world/img/logo/logo_push_world_og.png",
                    "action1_title" => "Кнопка-1 (Блог)",
                    "action1_url" => "https://push.world/help",
                    "action2_title" => "Кнопка-2 (Статья)",
                    "action2_url" => "https://push.world/help/payload-encryption",
                    "duration" => 45,
                    "life_time" => 3600,
                    "send_after" => 300,
                ]),
                'subsribers' => [],
            ],
        ];

        return self::makeRequest($url, 'POST', $params);
    }

    public static function getAuthToken()
    {

        $url = 'https://api.push.world/v2/oauth/access_token';

        $params = [
            'form_params' => [
                'client_id'   => env('PW_CLIENT_ID'),
                'client_secret'  => env('PW_SECRET'),
                'grant_type' => 'client_credentials',
            ],
        ];

        return self::makeRequest($url, 'POST', $params);
    }

    private static function makeRequest($url, $method, $params = [])
    {
        try {
            $client = new \GuzzleHttp\Client();

            $response = $client->request($method, $url, $params);

            $response = json_decode($response->getBody());

            return $response;
        } catch (\Exception $e) {

            return [
                'success' => false,
                'errors'  => $e->getMessage(),
            ];
        }
    }
}