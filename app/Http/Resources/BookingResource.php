<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'activityId' => $this->activity_id,
            'memberId' => $this->member_id,
            'bookingDate' => $this->booking_date,
            'status' => $this->status,
            'activityInfo' => new ActivityResource($this->whenLoaded('activity')),
            'userInfo' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
