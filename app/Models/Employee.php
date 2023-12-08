<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Award;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'other_names',
        'date_of_birth',
        'gender_id',
        'nationality_id',
        'contact_number',
        'geo_state_id',
        'geo_lga_id',
        'rank_id',
        'step',
        'zip_code',
        'hire_date',
        'office_id',
        'department_id',
        'division_id',
        'unit_id',
        'designation_id',
        'blood_group',
        'height',
        'genotype',
        'command_id',
        'duty_post',
        'maritalstatus_id',
        'next_of_kin',
        'nok_number',
        'nok_email',
        'permanent_home_address',
        'residential_address',
        'photograph',
        'service_number',
        'nin',
        'passport_number',
        'exit_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'geo_state_id' => 'integer',
        'geo_lga_id' => 'integer',
        'rank_id' => 'integer',
        'command_id' => 'integer',
        'office_id' => 'integer',
        'department_id' => 'integer',
        'division_id' => 'integer',
        'unit_id' => 'integer',
        'designation' => 'integer',
    ];

    public function ranks()
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }

    public function workHistories()
    {
        return $this->hasMany(WorkHistory::class);
    }

    public function empQualifications()
    {
        return $this->hasMany(EmpQualification::class);
    }

    public function empCertifications()
    {
        return $this->hasMany(EmpCertification::class);
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    public function deployments()
    {
        return $this->hasMany(Deployment::class);
    }

    public function awards()
    {
        return $this->hasMany(Award::class);
    }

    public function disciplines()
    {
        return $this->hasMany(Discipline::class);
    }


    public function geoState()
    {
        return $this->belongsTo(GeoState::class);
    }

    public function geoLga()
    {
        return $this->belongsTo(GeoLga::class);
    }

    public function commands(){
        return $this->belongsTo(Command::class, 'command_id');
    }

    public function offices()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function divisions()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function genders(){
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function nationalities()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function maritalstatus()
    {
        return $this->belongsTo(MaritalStatus::class, 'maritalstatus_id');
    }

    public function designations()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }
}
