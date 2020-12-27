<?php

namespace App\Models;
use App\Models\Materia;
use App\Models\Aula;
use App\Models\Sesion;
use App\Models\User;
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
        'aula_id',
    ];

    // One to many (inverse)
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function sesion()
    {
        return $this->belongsTo('App\Models\Sesion');
    }

    public function materia()
    {
        return $this->belongsTo('App\Models\Materia');
    }

    public function aula()
    {
        return $this->belongsTo('App\Models\Aula');
    }


    // One to many
    public function mesas()
    {
        return $this->hasMany(Mesa::class);
    }
}
