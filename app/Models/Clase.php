<?php

namespace App\Models;
use App\Models\Materia;
use App\Models\Aula;
use App\Models\Sesion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;
    protected $fillable = [

        'dia',
        'sesion_id',
        'materia_id',
        'aula_id'
    ];

    public function materia()
    {
        return $this->belongsTo('App\Models\Materia');
    }

    public function aula()
    {
        return $this->belongsTo('App\Models\Aula');
    }

    public function sesion()
    {
        return $this->belongsTo('App\Models\Sesion');
    }
}
