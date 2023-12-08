<?php

namespace App\Http\Resources;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'nationality' => $this->nationality,
            'contact_number' => $this->contact_number,
            'geo_state_id' => $this->geo_state_id,
            'geo_lga_id' => $this->geo_lga_id,
            'grade_level_id' => $this->grade_level_id,
            'step_id' => $this->step_id,
            'zip_code' => $this->zip_code,
            'hire_date' => $this->hire_date,
            'office_id' => new OfficeResource($this->whenLoaded('office_id')),
            'department_id' => $this->department_id,
            'division_id' => $this->division_id,
            'unit_id' => $this->unit_id,
            'blood_group' => $this->blood_group,
            'height' => $this->height,
            'genotype' => $this->genotype,
            'command' => $this->command,
            'duty_post' => $this->duty_post,
            'marital_status' => $this->marital_status,
            'next_of_kin' => $this->next_of_kin,
            'nok_number' => $this->nok_number,
            'nok_email' => $this->nok_email,
            'permanent_home_address' => $this->permanent_home_address,
            'residential_address' => $this->residential_address,
            'photograph' => $this->photograph,
            'service_number' => $this->service_number,
            'file_number' => $this->file_number,
            'fingerprint' => $this->fingerprint,
            'nin' => $this->nin,
            'passport_number' => $this->passport_number,
            'exit_date' => $this->exit_date,
            'designation' => DesignationResource::make($this->whenLoaded('designation')),
            'workHistories' => new WorkExperienceCollection($this->workHistories),
            'empQualifications' => new EmpQualificationCollection($this->empQualifications),
        ];
    }
}