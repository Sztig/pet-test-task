<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'status' => 'required|in:available,pending,sold',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The pet name is required.',
            'name.max' => 'The pet name may not be greater than 255 characters.',
            'status.required' => 'The pet status is required.',
            'status.in' => 'The pet status must be either available, pending, or sold.',
        ];
    }
}
