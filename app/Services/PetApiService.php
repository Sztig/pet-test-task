<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PetApiService implements PetApiServiceInterface
{
    private string $apiUrl = 'https://petstore.swagger.io/v2/pet/';
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('app.api_key');
    }

    private function getHeaders(): array
    {
        return [
            'api-key' => $this->apiKey,
            'Accept' => 'application/json',
        ];
    }

    public function petExists(int $id): bool
    {
        try {
            return Http::withHeaders($this->getHeaders())->get($this->apiUrl . $id)->successful();
        } catch (\Exception $e) {
            return false;
        }
    }

    private function handleApiCall(callable $apiCall): array
    {
        try {
            $response = $apiCall();
            if ($response->successful()) {
                return $response->json();
            }
            throw new \Exception('API call failed: ' . $response->body());
        } catch (\Exception $e) {
            throw new \Exception('Error calling API: ' . $e->getMessage());
        }
    }

    public function getAllPets(string $status = 'available'): array
    {
        return $this->handleApiCall(function () use ($status) {
            return Http::withHeaders($this->getHeaders())
                ->get($this->apiUrl . 'findByStatus?status=' . $status);
        });
    }

    public function getPet(int $id): array
    {
        return $this->handleApiCall(function () use ($id) {
            return Http::withHeaders($this->getHeaders())
                ->get($this->apiUrl . $id);
        });
    }

    public function createPet(array $data): array
    {
        return $this->handleApiCall(function () use ($data) {
            return Http::withHeaders($this->getHeaders())
                ->post($this->apiUrl, $data);
        });
    }

    public function updatePet(int $id, array $data): array
    {
        $data['id'] = $id;
        return $this->handleApiCall(function () use ($data) {
            return Http::withHeaders($this->getHeaders())
                ->put($this->apiUrl, $data);
        });
    }

    public function deletePet(int $id): array
    {
        return $this->handleApiCall(function () use ($id) {
            return Http::withHeaders($this->getHeaders())
                ->delete($this->apiUrl . $id);
        });
    }
}
