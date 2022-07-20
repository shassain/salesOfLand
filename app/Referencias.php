<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referencias extends Model
{
    protected $table="caracteristicas";
    protected $fillable=["icono","color","tabla","precio"];
}
