<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $fillable = [
        'nombre',
        'faltas',
        'calificacion',
        'equivalencia',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}