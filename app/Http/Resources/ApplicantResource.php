<?php

namespace App\Http\Resources;

use App\Models\GeoLga;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date_of_birth' => $this->date_of_birth,
            'nin' => $this->nin,
            'reg_no' => $this->reg_no,
            'gender' => $this->gender,
            'address' => $this->address,
            'city' => $this->city,
            'geo_state_id' => $this->geo_state_id,
            'geoState' => new GeoStateResource($this->whenLoaded('geoState')),
            'geo_lga_id' => $this->geo_lga_id,
            'geoLga' => new GeoLgaResource($this->whenLoaded('geoLga')),
            'zip_postal_code' => $this->zip_postal_code,
            'email_address' => $this->email_address,
            'phone_number' => $this->phone_number,
            'is_submitted' => $this->is_submitted,
            'cover_letter' => $this->cover_letter,
            'cbt_date' => $this->cbt_date,
            'cbt_score' => $this->cbt_score,
            'interview_date' => $this->interview_date,
            'user' => new UserResource($this->user),
            'jobPosition' => new JobPositionResource($this->jobPosition),
            'references' => ReferenceCollection::make($this->whenLoaded('references')),
            'workExperiences' => WorkExperienceCollection::make($this->whenLoaded('workExperiences')),
            'qualifications' => QualificationCollection::make($this->whenLoaded('qualifications')),
            'certifications' => CertificationCollection::make($this->whenLoaded('certifications')),
            'jobApplication' => JobApplicationResource::make($this->whenLoaded('jobApplication')),
            'shortlistedApplicant' => ShortlistedApplicantResource::make($this->whenLoaded('shortlistedApplicant')),
        ];
    }
}
