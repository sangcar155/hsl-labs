<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        // For now allow — controller will do provider check.
        return true;
    }

    public function rules(): array
    {
        return [
            'provider_id'  => 'required|exists:providers,id',
            'inventory_id' => 'required|exists:inventories,id',
            'patient_id'   => 'nullable|exists:patients,id',
            'quantity'     => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'provider_id.required' => 'Provider is required.',
            'inventory_id.required' => 'Product is required.',
            'quantity.min' => 'Quantity must be at least 1.',
        ];
    }
}
