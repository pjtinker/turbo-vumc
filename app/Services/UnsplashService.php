<?php

namespace App\Services;

use GuzzleHttp\Client;

class UnsplashService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.unsplash.com/',
        ]);
    }

    public function getRandomImages($keyword = null, $count = 1)
    {
        $queryParameters = [
            'client_id' => env('UNSPLASH_ACCESS_KEY'),
            'count' => $count,
        ];

        if ($keyword) {
            $queryParameters['query'] = $keyword;
        }

        $response = $this->client->request('GET', 'photos/random', [
            'query' => $queryParameters,
        ]);

        return json_decode($response->getBody());
    }

    public function getRandomImageThumbnail($keyword = null)
    {
        $response = $this->getRandomImages($keyword);

        return $response[0]->urls->thumb;
    }
}
