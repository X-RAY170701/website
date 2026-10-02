<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $productId = $this->route('product')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($productId)],
            'type' => ['required', Rule::in(['digital_file', 'service', 'other'])],
            'category' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'price_label' => ['nullable', 'string', 'max:255'],
            'external_link' => ['nullable', 'url', 'max:255'],
            'external_link_label' => ['nullable', 'string', 'max:100'],
            'external_link_2' => ['nullable', 'url', 'max:255'],
            'external_link_2_label' => ['nullable', 'string', 'max:100'],
            'demo_note' => ['nullable', 'string', 'max:1000'],
            'cta_label' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
