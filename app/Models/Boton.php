<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boton extends Model
{
    use HasFactory;
    protected $fillable = [
        'default',
        'v_last',
        'bt_name',
        'descripcion',
        'pasos',
        'items',
        'botontipo_id',
        'user_id'];

    /**
     * Relaciones entre modelos
     */

    // One to many (inverse)
    public function botontipo(){
        return $this->belongsTo('App\Models\Botontipo');
    }
    // One to many (inverse)
    public function user(){
        if($this !== null)
        return $this->belongsTo('App\Models\User');
    }

}
