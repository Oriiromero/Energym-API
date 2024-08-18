<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivityRequest extends FormRequest
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
            'trainerId' => ['required', 'exists:trainers,id'],
            'name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:200'],
            'schedule' => ['required', 'date'],
            'capacity' => ['required', 'numeric']
        ];
    }

    protected function prepareForValidation()
    {
        if($this->trainerId)
        {
            $this->merge([
                'trainer_id' => $this-> trainerId,
            ]);
        }
    }
}
