<?php

namespace App\Models;

use App\Models\Materia;
use App\Models\Aula;
use App\Models\Mesa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'apellidos',
        'nombre_completo',
        'materia_id'
    ];

    public function materia()
    {
        return $this->belongsTo('App\Models\Materia');
    }
}
