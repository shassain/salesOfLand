<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table="caracteristicas";
    protected $fillable=["icono","color","tabla","precio","nombre"];
}