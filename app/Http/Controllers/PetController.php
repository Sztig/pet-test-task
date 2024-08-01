<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetRequest;
use App\Services\PetApiServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PetController
{
    public function __construct(
        private PetApiServiceInterface $petApiService
    ) {
    }

    public function index(Request $request): View
    {
        $status = $request->query('status', 'available');
        $pets = $this->petApiService->getAllPets($status);
        $statuses = ['available', 'pending', 'sold'];
        return view('pets.index', compact('pets', 'statuses', 'status'));
    }

    public function create(): View
    {
        return view('pets.create');
    }

    public function store(PetRequest $request): RedirectResponse
    {
        $this->petApiService->createPet($request->validated());
        return redirect()->route('pets.index')->with('success', 'Pet created successfully.');
    }

    public function show(int $id): View|RedirectResponse
    {
        if (!$this->petApiService->petExists($id)) {
            return redirect()->route('pets.index')->with('error', 'Pet not found. It may have been removed.');
        }

        $pet = $this->petApiService->getPet($id);
        return view('pets.show', compact('pet'));
    }

    public function edit(int $id): View|RedirectResponse
    {
        if (!$this->petApiService->petExists($id)) {
            return redirect()->route('pets.index')->with('error', 'Pet not found. It may have been removed.');
        }

        $pet = $this->petApiService->getPet($id);
        return view('pets.edit', compact('pet'));
    }

    public function update(PetRequest $request, int $id): RedirectResponse
    {
        if (!$this->petApiService->petExists($id)) {
            return redirect()->route('pets.index')->with('error', 'Pet not found. It may have been removed.');
        }

        $this->petApiService->updatePet($id, $request->validated());
        return redirect()->route('pets.show', $id)->with('success', 'Pet updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        if (!$this->petApiService->petExists($id)) {
            return redirect()->route('pets.index')->with('error', 'Pet not found. It may have already been removed.');
        }

        $this->petApiService->deletePet($id);
        return redirect()->route('pets.index')->with('success', 'Pet deleted successfully.');
    }
}
