<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'training_title' => $this->training_title,
            'training_instite' => $this->training_instite,
            'training_location' => $this->training_location,
            'training_duration' => $this->training_duration,
            'training_date_from' => $this->training_date_from,
            'training_date_to' => $this->training_date_to,
            'created_by' => $this->created_by,
            'users' => UserCollection::make($this->whenLoaded('users')),
        ];
    }
}
