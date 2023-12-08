<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeploymentResource extends JsonResource
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
            'location_of_deployment' => $this->location_of_deployment,
            'date_of_deployment' => $this->date_of_deployment,
            'reason_for_deployment' => $this->reason_for_deployment,
            'created_by' => $this->created_by,
            'users' => UserCollection::make($this->whenLoaded('users')),
        ];
    }
}
