<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
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
                'activityId' => ['required'],
                'memberId' => ['required'],
                'bookingDate' => ['required'],
                'status' => ['required']
            ];
        }
       else 
        {
            return [
                'activityId' => ['sometimes', 'required'],
                'memberId' => ['sometimes', 'required'],
                'bookingDate' => ['sometimes', 'required'],
                'status' => ['sometimes', 'required']
            ];
        }
    }

    protected function prepareForValidation()
    {
        if($this->activityId)
        {
            $this->merge([
                'activity_id' => $this-> activityId,
            ]);
        }
        if($this->memberId)
        {
            $this->merge([
                'member_id' => $this-> memberId,
            ]);
        }
        if($this->bookingDate)
        {
            $this->merge([
                'booking_date' => $this-> bookingDate,
            ]);
        }
    }
}
