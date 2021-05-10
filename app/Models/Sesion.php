<?php

namespace App\Models;
// use App\Models\User;
// use App\Models\Clase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use HasFactory;
    protected $fillable = [
        'inicio',
        'fin',
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
    // hasManyThrough
    public function mesas(){
        return $this->hasManyThrough('App\Models\Mesa','App\Models\Clase');
    }
}