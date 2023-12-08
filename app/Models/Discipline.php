<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'offence_desc',
        'action_taken',
        'reported_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */


    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function reportedBy()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }
}
