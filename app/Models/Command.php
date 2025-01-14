<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    use HasFactory;

    protected $fillable = [
      'command'
    ];


    public function offices()
    {
        return $this->hasMany(Office::class);
    }
}
