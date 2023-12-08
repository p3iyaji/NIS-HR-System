<?php

namespace App\Models;

use App\Enums\E_ApplicantGender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Applicant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_of_birth',
        'nin',
        'gender',
        'address',
        'city',
        'geo_state_id',
        'geo_lga_id',
        'zip_postal_code',
        'email_address',
        'phone_number',
        'user_id',
        'job_position_id',
        'is_submitted',
        'cover_letter',
        'is_nin_verified',
        'cbt_date',
        'cbt_score',
        'interview_date',
        'reg_no',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date_of_birth' => 'date',
        'interview_date' => 'date',
        'geo_state_id' => 'integer',
        'geo_lga_id' => 'integer',
        'user_id' => 'integer',
        'job_position_id' => 'integer',
        'is_submitted' => 'integer',
        'gender' => E_ApplicantGender::class,
    ];

    public function workExperiences(): HasMany
    {
        return $this->hasMany(WorkExperience::class);
    }

    public function qualifications(): HasMany
    {
        return $this->hasMany(Qualification::class);
    }

    public function certifications(): HasMany
    {
        return $this->hasMany(Certification::class);
    }

    public function references(): HasMany
    {
        return $this->hasMany(Reference::class);
    }

    public function shortlistedApplicant(): HasOne
    {
        return $this->hasOne(ShortlistedApplicant::class);
    }

    public function jobApplication(): HasOne
    {
        return $this->hasOne(JobApplication::class);
    }

    public function geoState(): BelongsTo
    {
        return $this->belongsTo(GeoState::class);
    }

    public function geoLga(): BelongsTo
    {
        return $this->belongsTo(GeoLga::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobPosition(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class);
    }
}
