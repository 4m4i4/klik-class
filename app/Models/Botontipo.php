<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Botontipo extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo'];
    /**
     * Relaciones entre modelos
     */

    // One to many
    public function botons(){
        return $this->hasMany('App\Models\Boton');
    }
}