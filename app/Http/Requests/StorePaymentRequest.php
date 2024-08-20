<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'memberId' => ['required', 'exists:users,id'],
            'subscriptionId' => ['required', 'exists:subscriptions,id'],
            'paymentMethod' => ['required', 'string', 'max:100'],
            'paymentStatus' => ['required', 'string', 'max:100'],
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
