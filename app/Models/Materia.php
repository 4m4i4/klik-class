<?php

namespace App\Models;
// use App\Models\User;

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

    // One to many (inverse)
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    // One to many
    public function clases()
    {
        return $this->hasMany('App\Models\Clase');
    }
    public function estudiantes()
    {
        return $this->hasMany('App\Models\Estudiante');
    }    
    //hasOneThrough: puede estar mal (igual es 'many')
    public function mesa()
    {
        return $this->hasOneThrough('App\Models\Mesa','App\Models\Estudiante');
    }





}
