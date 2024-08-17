<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrainerRequest extends FormRequest
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
                'name' => ['required', 'string', 'max:150'],
                'speciality' => ['required', 'string', 'max:100'],
                'availability' => ['required', 'date']
            ];
        }
        else{
            return [
                'name' => ['sometimes', 'required', 'string', 'max:150'],
                'speciality' => ['sometimes', 'required', 'string', 'max:100'],
                'availability' => ['sometimes', 'required', 'date']
            ];
        }
    }
}
