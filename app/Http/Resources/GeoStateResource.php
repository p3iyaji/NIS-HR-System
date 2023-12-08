<?php

namespace App\Http\Resources;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeoStateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'geoLgas' => GeoLgaCollection::make($this->whenLoaded('geoLgas')),
            'applicants' => new ApplicantCollection($this->whenLoaded('applicants')),
        ];
    }
}
