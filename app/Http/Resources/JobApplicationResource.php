<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'applicant_id' => $this->applicant_id,
            'job_position_id' => $this->job_position_id,
            'application_date' => $this->application_date,
            'status' => $this->status,
            'screening_date' => $this->screening_date,
            'comment_note' => $this->comment_note,
        ];
    }
}
