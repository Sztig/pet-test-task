<?php

namespace App\Services;

interface PetApiServiceInterface
{
    public function getAllPets(): array;
    public function getPet(int $id): array;
    public function createPet(array $data): array;
    public function updatePet(int $id, array $data): array;
    public function deletePet(int $id): array;
}
