<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'type_delivery' => 'required|string|in:pickup,delivery',
            'warehouse_id' => 'nullable|integer|exists:addresses,id,is_warehouse,1',
            'delivery_date' => 'nullable|date|after_or_equal:today',
            'saved_address_id' => 'nullable|integer|exists:addresses,id',
            'delivery_address' => 'nullable|string|max:255',
        ];
    }
}
