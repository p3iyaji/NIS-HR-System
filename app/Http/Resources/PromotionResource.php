<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'old_job_title' => $this->old_job_title,
            'new_job_title' => $this->new_job_title,
            'promotion_date' => $this->promotion_date,
            'next_promotion_due_date' => $this->next_promotion_due_date,
            'created_by' => $this->created_by,
            'users' => UserCollection::make($this->whenLoaded('users')),
        ];
    }
}
