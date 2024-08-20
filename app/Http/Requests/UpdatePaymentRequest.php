<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
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
                'memberId' => ['required'],
                'subscriptionId' => ['required'],
                'paymentMethod' => ['required'],
                'paymentStatus' => ['required'],
            ];
        }
        else 
        {
            return [
                'memberId' => ['sometimes', 'required'],
                'subscriptionId' => ['sometimes', 'required'],
                'paymentMethod' => ['sometimes', 'required'],
                'paymentStatus' => ['sometimes', 'required'],
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

        if($this->subscriptionId)
        {
            $this->merge([
                'subscription_id' => $this->subscriptionId,
            ]);
        }

        if($this->paymentMethod)
        {
            $this->merge([
                'payment_method' => $this->paymentMethod,
            ]);
        }

        if($this->paymentStatus)
        {
            $this->merge([
                'payment_status' => $this->paymentStatus,
            ]);
        }
    }
}
