<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingList extends Model
{
    use HasFactory;


    protected $fillable = [
      'title',
      'type',
    ];

    protected $casts = [
        'id' => 'integer',
        'type' => 'integer',
    ];

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function types()
    {
        return $this->belongsTo(Types::class, 'type');
    }
}
