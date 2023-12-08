<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmpQualificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'institution' => $this->institution,
            'certificate_obtained' => $this->certificate_obtained,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}
