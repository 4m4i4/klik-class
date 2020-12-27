<?php

namespace App\Models;
use App\Models\User;

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


    // One to many (inverse)
   public function user()
   {
       return $this->belongsTo('App\Models\User');
   }
    // One to many
    public function mesas()
    {
        return $this->hasMany(Mesa::class);
    }
    public function clase()
    {
        return $this->hasOne(Clase::class);
    }
    // hasOneThrough
    public function mesa()
    {
        return $this->hasOneThrough(Mesa::class,Clase::class);
    }

}
