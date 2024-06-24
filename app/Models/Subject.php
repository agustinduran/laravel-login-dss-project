<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // Nombre de la materia
    ];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
