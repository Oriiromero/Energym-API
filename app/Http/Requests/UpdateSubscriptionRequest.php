<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriptionRequest extends FormRequest
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
                'memberId' => ['required'],
                'subType' => ['required'],
                'startDate' => ['required'],
                'endDate' => ['required'],
                'status' => ['required'],
                'price' => ['required']
            ];
        }
        else 
        {
            return [
                'name' => ['sometimes', 'required'],
                'memberId' => ['sometimes','required'],
                'subType' => ['sometimes','required'],
                'startDate' => ['sometimes','required'],
                'endDate' => ['sometimes','required'],
                'status' => ['sometimes','required'],
                'price' => ['sometimes','required']
            ];
        }
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
