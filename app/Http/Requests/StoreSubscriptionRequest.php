<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriptionRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'memberId' => ['required', 'exists:users,id'],
            'subType' => ['required', 'string', 'max:50'],
            'startDate' => ['required', 'date'],
            'endDate' => ['required', 'date'],
            'status' => ['required', 'string', 'max:60'],
            'price' => ['required', 'numeric']
        ];
    }

    protected function prepareForValidation() 
    {
        if($this->memberId)
        {
            $this->merge([
                'member_id' => $this->memberId,
            ]);
        }

        if($this->subType)
        {
            $this->merge([
                'sub_type' => $this->subType,
            ]);
        }

        if($this->startDate)
        {
            $this->merge([
                'start_date' => $this->startDate,
            ]);
        }

        if($this->endDate)
        {
            $this->merge([
                'end_date' => $this->endDate,
            ]);
        }
    }
}
