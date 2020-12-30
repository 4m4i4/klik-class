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

    // One to many (inverse)
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function clases()
    {
        return $this->hasMany('App\Models\Clase');
    }
    public function mesa()
    {
        return $this->hasOneThrough('App\Models\Mesa','App\Models\Clase');
    }
}
