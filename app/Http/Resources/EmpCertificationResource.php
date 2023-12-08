<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmpCertificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'certification_name' => $this->certification_name,
            'issuing_authority' => $this->issuing_authority,
            'date_obtained' => $this->date_obtained,
        ];
    }
}
