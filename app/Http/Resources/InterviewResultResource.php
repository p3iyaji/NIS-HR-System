<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InterviewResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'interview_criteria_id' => $this->interview_criteria_id,
            'applicant_id' => $this->applicant_id,
            'response' => $this->response,
        ];
    }
}
