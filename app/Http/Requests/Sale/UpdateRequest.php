<?php

namespace App\Http\Requests\Sale;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'customer_to'  => 'required|string',
            'customer_email' => 'string|nullable',
            'customer_phone' => 'string|nullable',
            'user_id' => 'int|nullable',
            // 'product_data' => 'required|array'
        ];
    }
}
