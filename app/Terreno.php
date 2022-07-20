<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terreno extends Model
{
	protected $fillable=["manzano","nro_lote","categoria_id","superficie","estado","precoi_x_mtr2","valor_terreno","proyecto_id","descuento_general","descuento_promocion","precio_venta"];
	public function coordenadas(){
		return $this->hasMany(Coordenadas::class);
	}
	public function proyecto(){
		return $this->belongsTo(Proyecto::class);
	}
	public function categoria(){
		return $this->belongsTo(Categorias::class);
	}
}
