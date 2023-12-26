<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'name' => ['Required'],
                'type' => ['Required', Rule::in(['I', 'B', 'i', 'b'])],
                'email' => ['Required', 'email'],
                'address' => ['Required'],
                'city' => ['Required'],
                'state' => ['Required'],
                'postalCode' => ['Required'],
            ];
        } else {
            return [
                'name' => ['sometimes', 'Required'],
                'type' => ['sometimes', 'Required', Rule::in(['I', 'B', 'i', 'b'])],
                'email' => ['sometimes', 'Required', 'email'],
                'address' => ['sometimes', 'Required'],
                'city' => ['sometimes', 'Required'],
                'state' => ['sometimes', 'Required'],
                'postalCode' => ['sometimes', 'Required'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if($this->postalCode)
        $this->merge([
            'postal_code' => $this->postalCode,
        ]);
    }
}
