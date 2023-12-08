<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'applicant_id' => $this->applicant_id,
            'certification_name' => $this->certification_name,
            'issuing_authority' => $this->issuing_authority,
            'date_obtained' => $this->date_obtained,
        ];
    }
}
