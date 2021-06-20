<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Aula;
class AulaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public $preserveKeys = true;
    public function toArray($request)
    {
         return parent::toArray($request);
        // return [
        //     'id' => $this->id,
        //     'aula_name' => $this->aula_name ,
        //     'num_columnas' => $this->num_columnas ,
        //     'num_filas' => $this->num_filas,
        //     'num_mesas' => $this->num_mesas ,
        //     'user_id' => $this->user_id 
        // ];
    }
}
