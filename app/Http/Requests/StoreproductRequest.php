<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreproductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Basic info
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            // Gold-specific attributes
            'weight' => ['required', 'numeric', 'min:0.01'],
            'karat' => ['required', 'integer', 'in:18,21,22,24'],
            'type' => ['nullable', 'string', 'max:100'],

            // Pricing
            'gold_price_per_gram' => ['required', 'numeric', 'min:0'],
            'making_fee' => ['nullable', 'numeric', 'min:0'],
            'total_price' => ['required', 'numeric', 'min:0'],

            // Stock
            'stock' => ['required', 'integer', 'min:0'],

            // Category
            'category_id' => ['nullable', 'exists:categories,id'],

            // Images
            'images' => ['nullable', 'array'],
            'images.*' => ['string'], // or 'image' if uploading files

            // Status
            'is_active' => ['boolean'],
        ];
    }
}
