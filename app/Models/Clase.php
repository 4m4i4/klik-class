<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;
    protected $fillable = [
        'dia',
        'user_id',
        'sesion_id',
        'materia_id',
    ];
    const DIAS =['Horario','Lunes','Martes','Miercoles','Jueves','Viernes'];

    /**
     * Relaciones entre modelos
     */

    // One to many (inverse)
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    // One to one (inverse)
    public function sesion(){
        return $this->belongsTo('App\Models\Sesion');
    }
    // One to many (inverse)
    public function materia(){
        return $this->belongsTo('App\Models\Materia');
    }
}