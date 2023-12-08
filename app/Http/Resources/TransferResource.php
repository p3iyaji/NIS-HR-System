<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'current_location' => $this->current_location,
            'location_of_tranfer' => $this->location_of_tranfer,
            'date_of_transfer' => $this->date_of_transfer,
            'reason_for_transfer' => $this->reason_for_transfer,
            'created_by' =>UserCollection::make($this->whenLoaded('users')),
        ];
    }
}
