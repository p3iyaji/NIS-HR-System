<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortlistedApplicantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'job_position_id' => $this->job_position_id,
            'applicant_id' => $this->applicant_id,
            'interview_date' => $this->interview_date,
            'comment' => $this->comment,
            'status' => $this->status,
        ];
    }
}
