<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable=["nombre","descripcion","lista","posx","posy","lugar","alcaldia"];
    public function imagenes(){
    	return $this->hasMany(Imgproyect::class);
    }
    public function terrenos(){
    	return $this->hasMany(Terreno::class);
    }		
}
