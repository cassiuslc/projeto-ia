<?php

namespace App\Services;

use GuzzleHttp\Client;

class GPT4AllService
{
    protected $apiKey;
    protected $client;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => env("GPT4ALL_URL"),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);
    }

    public function completeChat($messages, $model = 'mistral-7b-openorca.Q4_0', $temperature = 0.18)
    {
        $response = $this->client->post('/v1/chat/completions', [
            'json' => [
                'model' => $model,
                'messages' => $messages,
                'temperature' => $temperature,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function complete($prompt, $model = 'mistral-7b-openorca.Q4_0', $maxTokens = 50, $temperature = 0.18, $topP = 1.0, $topK = 50, $n = 1, $stream = false, $repeatPenalty = 1.18)
    {
        $response = $this->client->post('/v1/completions', [
            'json' => [
                'model' => $model,
                'prompt' => $prompt,
                'max_tokens' => $maxTokens,
                'temperature' => $temperature,
                'top_p' => $topP,
                'top_k' => $topK,
                'n' => $n,
                'stream' => $stream,
                'repeat_penalty' => $repeatPenalty,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function listEngines()
    {
        $response = $this->client->get('/v1/engines');

        return json_decode($response->getBody(), true);
    }

    public function retrieveEngine($engineId)
    {
        $response = $this->client->get("/v1/engines/{$engineId}");

        return json_decode($response->getBody(), true);
    }

    public function healthCheck()
    {
        try {
            $response = $this->client->get('/v1/health', ['timeout' => 10]);
            return $response->getStatusCode() === 200;
        } catch (\Exception $e) {
            return false;
        }
    }


}

