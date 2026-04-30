<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:999999.99',
            'description' => 'required|string|max:2048',
            'address_ids' => 'required|array',
            'address_ids.*' => 'required|integer|exists:addresses,id',
            'product_quantities' => 'required|array',
            'product_quantities.*' => 'required|integer',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|integer|exists:categories,id',
            'sub_category_id' => 'required|integer|exists:sub_categories,id',
            'properties' => 'nullable|array',
            'properties.*' => 'required|integer|exists:properties,id',
            'property_values' => 'nullable|array',
            'property_values.*' => 'required|string',

        ];
    }
}
