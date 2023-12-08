<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobPositionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'position_name' => $this->position_name,
            'department' => $this->department,
            'job_description' => $this->job_description,
            'required_qualifications' => $this->required_qualifications,
            'applicant_deadline' => $this->applicant_deadline,
            'status' => $this->status,
            'deleted_at' => $this->deleted_at,
            'applicants' => ApplicantCollection::make($this->whenLoaded('applicants')),
        ];
    }
}
