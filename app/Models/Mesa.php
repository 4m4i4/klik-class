<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;
    protected $fillable = [
        'columna',
        'fila',
        'is_ocupada',
        'user_id',
        'aula_id',
        'estudiante_id'
    ];
    
    // One to many (inverse)
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    // One to many (inverse)
    public function aula(){
        return $this->belongsTo('App\Models\Aula');
    }
    // One to one (inverse)
    public function estudiante(){
        return $this->belongsTo('App\Models\Estudiante');
    }
}
