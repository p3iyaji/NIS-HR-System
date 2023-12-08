<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'is_active' => $this->is_active,
            'email_verified_at' => $this->email_verified_at,
            'profile_picture' => filter_var($this->profile_picture, FILTER_VALIDATE_URL) ? $this->profile_picture : (is_null($this->profile_picture) ? null : config('app.url') . '/file/get/' . $this->profile_picture),
            'userRole' => new UserRoleResource($this->userRole),
            'applicant' => new ApplicantResource($this->whenLoaded('applicant')),
        ];
    }
}
