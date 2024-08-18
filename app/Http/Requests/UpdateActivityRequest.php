<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateActivityRequest extends FormRequest
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
                'trainerId' => ['required'],
                'name' => ['required'],
                'description' => ['required'],
                'schedule' => ['required'],
                'capacity' => ['required']
            ];
        }
        else
        {
            return [
                'trainerId' => ['sometimes', 'required'],
                'name' => ['sometimes', 'required'],
                'description' => ['sometimes', 'required'],
                'schedule' => ['sometimes', 'required'],
                'capacity' => ['sometimes', 'required']
            ];
        }
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
