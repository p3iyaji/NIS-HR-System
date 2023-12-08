<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReferenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'applicant_id' => $this->applicant_id,
            'referrer_name' => $this->referrer_name,
            'referrer_email' => $this->referrer_email,
            'referrer_mobile' => $this->referrer_mobile,
            'relationship_applicant' => $this->relationship_applicant,
        ];
    }
}
