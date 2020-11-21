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
        'num_mesas'
   ];


}
