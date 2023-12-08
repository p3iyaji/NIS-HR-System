<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QualificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'applicant_id' => $this->applicant_id,
            'institution' => $this->institution,
            'certificate_obtained' => $this->certificate_obtained,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}
