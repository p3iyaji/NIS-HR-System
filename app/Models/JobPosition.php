<?php

namespace App\Models;

use App\Enums\E_JobPositionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobPosition extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position_name',
        'department',
        'job_description',
        'required_qualifications',
        'applicant_deadline',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'deleted_at' => 'datetime',
        'status' => E_JobPositionStatus::class,
    ];

    public function shortlistedApplicants(): HasMany
    {
        return $this->hasMany(ShortlistedApplicant::class);
    }

    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class);
    }
}
