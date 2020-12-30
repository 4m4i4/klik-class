<?php

namespace App\Models;
// use App\Models\Clase;
// use App\Models\Aula;
// use App\Models\Estudiante;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;
    protected $fillable = [
        'columna',
        'fila',
        'is_ocupada',
        'clase_id',
        'aula_id',
        'estudiante_id'
    ];
    
    // One to many (inverse)
    public function clase()
    {
        return $this->belongsTo('App\Models\Clase');
    }
    
    // One to many (inverse)
    public function aula()
    {
        return $this->belongsTo('App\Models\Aula');
    }
    
    // One to many (inverse)
    public function estudiante()
    {
        return $this->belongsTo('App\Models\Estudiante');
    }
}
