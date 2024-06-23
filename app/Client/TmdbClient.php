<?php

namespace App\Client;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class TmdbClient
{
    /**
     * The tmdb client.
     *
     * @var \Illuminate\Http\Client\PendingRequest
     */
    protected $client;

    /**
     * Create a new class instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = Http::baseUrl(
            config('services.tmdb.base_url'),
        )->withHeaders([
            'Authorization' => 'Bearer ' . config('services.tmdb.token'),
            'Accept' => 'application/json',
        ]);
    }

    /**
     * Create a get request for TMDB.
     *
     * @param string $uri
     * @param array<string, string> $params
     * @return array<string, mixed>
     */
    public function get(string $uri, array $params = []): array
    {
        $response = $this->client->get($uri, $params);

        return $this->handleResponse($response);
    }

    /**
     * Create a post request for TMDB.
     *
     * @param string $uri
     * @param array<string, string> $data
     * @return array<string, mixed>
     */
    public function post(string $uri, array $data = []): array
    {
        $response = $this->client->post($uri, $data);

        return $this->handleResponse($response);
    }

    /**
     * Create a put request for TMDB.
     *
     * @param string $uri
     * @param array<string, string> $data
     * @return array<string, mixed>
     */
    public function put(string $uri, array $data = []): array
    {
        $response = $this->client->put($uri, $data);

        return $this->handleResponse($response);
    }

    /**
     * Create a delete request for TMDB.
     *
     * @param string $uri
     * @param array<string, string> $data
     * @return array<string, mixed>
     */
    public function delete(string $uri, array $data = []): array
    {
        $response = $this->client->delete($uri, $data);

        return $this->handleResponse($response);
    }

    /**
     * Handle the response from TMDB.
     *
     * @param \Illuminate\Http\Client\Response $response
     * @return array<string, mixed>
     */
    protected function handleResponse(Response $response): array
    {
        if ($response->successful()) {
            return $response->json();
        }

        $response->throw();
    }
}
