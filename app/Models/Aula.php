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
    public function mesas(){
        return $this->hasMany('App\Models\Mesa');
    }
    
    // One to One; NO Cambiado a One to many
    public function clase(){
        return $this->hasOne('App\Models\Clase');
    }
}