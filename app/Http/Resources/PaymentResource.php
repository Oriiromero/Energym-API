<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'memberId' => $this->member_id,
            'subscriptionId' => $this->subscription_id,
            'amount' => $this->amount,
            'paymentMethod' => $this->payment_method,
            'paymentStatus' => $this->payment_status,
            'subscriptionInfo' => new SubscriptionResource($this->whenLoaded('subscription')),
            'memberInfo' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
