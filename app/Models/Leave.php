<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Leave extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'leave_type_id',
        'leave_days',
        'start_date',
        'end_date',
        'reason',
        'status',
        'created_by',
        'approved_by',
        'date_applied',
        'approved_at',
        'remarks',
    ];



    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function users()
    {
        return $this->hasMany(User::class, 'created_by');
    }

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function leavetypes()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }

    public function statuses()
    {
        return $this->belongsTo(Status::class, 'status');
    }
}
