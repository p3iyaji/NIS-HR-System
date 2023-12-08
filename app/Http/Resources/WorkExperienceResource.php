<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkExperienceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'applicant_id' => $this->applicant_id,
            'organisation' => $this->organisation,
            'job_title' => $this->job_title,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}
