<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;
    protected $fillable = [
        'aula_name',
        'num_columnas',
        'num_filas',
        'num_mesas',
        'check',
        'user_id'
    ];

    /**
     * Relaciones entre modelos
     */

    // One to many (inverse)
    public function user(){
       return $this->belongsTo('App\Models\User');
    }
    // One to many
    public function materias(){
        return $this->hasMany('App\Models\Materia');
    }

    // // One to One (inverse)
    // public function materia(){
    //     return $this->belongsTo('App\Models\Materia');
    // }
    // One to many
    public function mesas(){
        return $this->hasMany('App\Models\Mesa');
    }
    // Has One through
    public function clase(){
        return $this->hasOneThrough('App\Models\Clase','App\Models\Materia');
    }
    // Has Many through
    public function estudiantes(){
        return $this->hasManyThrough('App\Models\Estudiante','App\Models\Materia');
    }
}