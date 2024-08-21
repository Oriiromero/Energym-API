<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

        if($method == 'PUT')
        {
            return [
                'name' => ['required'],
                'email' => ['required'],
                'role' => ['required'],
                'phone' => ['required'],
                'membershipStatus' => ['required'],
                'birthDate' => ['required'],
                'postalCode' => ['required']
            ];
        }
        else 
        {
            return [
                'name' => ['sometimes', 'required'],
                'email' => ['sometimes','required'],
                'role' => ['sometimes','required'],
                'phone' => ['sometimes','required'],
                'membershipStatus' => ['sometimes','required'],
                'birthDate' => ['sometimes','required'],
                'postalCode' => ['sometimes','required']
            ];
        }
    }

    protected function prepareForValidation() 
    {
        if($this->membershipStatus)
        {
            $this->merge([
                'membership_status' => $this->membershipStatus,
            ]);
        }

        if($this->birthDate)
        {
            $this->merge([
                'postal_code' => $this->birthDate,
            ]);
        }

        if($this->postalCode)
        {
            $this->merge([
                'postal_code' => $this->postalCode,
            ]);
        }
    }
}
