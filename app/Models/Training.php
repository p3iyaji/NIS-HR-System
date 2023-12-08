<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Training extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'training_list_id',
        'training_institute',
        'training_location',
        'training_duration',
        'training_start_date',
        'training_end_date',
        'created_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function traininglists()
    {
        return $this->belongsTo(TrainingList::class, 'training_list_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }
}
