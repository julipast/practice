<?php

namespace App\Http\Requests\Parking;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'admin_id' => '',
            'count' => 'numeric',
            'price' => 'numeric',
            'address' => 'string',
            'mark' => 'nullable|numeric',
            'status' => 'boolean',
            'start_date' => '',
            'end_date' => '',
        ];
    }
}
