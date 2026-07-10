<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


public function rules(): array
{
    return [
        'name' => ['required', 'string', 'max:255'],
        'description' => ['required', 'string'],
        'price' => ['required', 'numeric', 'min:0'],
        'stock' => ['required', 'integer', 'min:0'],
        'images' => ['nullable','array','max:6',],
        'images.*' => ['image','mimes:jpg,jpeg,png,webp','max:2048',],
        'is_active' => ['nullable', 'boolean'],
    ];
}
}