<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $fillable = [
        'materia_name', 
        'grupo',
        'user_id'
    ];

    /**
     * Relaciones entre modelos
     */

    // One to many (inverse)
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    // One to one
    public function clase(){
        return $this->hasOne('App\Models\Clase');
    }
    // One to many
    public function estudiantes(){
        return $this->hasMany('App\Models\Estudiante');
    }    
    // hasOneThrough
    public function mesa(){
        return $this->hasOneThrough('App\Models\Mesa','App\Models\Estudiante');
    }
}
