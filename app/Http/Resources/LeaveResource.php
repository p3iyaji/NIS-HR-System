<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'Leave_type' =>  LeaveTypeResource::make($this->whenLoaded('Leave_type')),
            'Leave_days' => $this->Leave_days,
            'Leave_date_from' => $this->Leave_date_from,
            'Leave_date_to' => $this->Leave_date_to,
            'leave_reason' => $this->leave_reason,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'approved_by' => $this->approved_by,
            'approved_at' => $this->approved_at,
            'users' => UserCollection::make($this->whenLoaded('users')),
        ];
    }
}
