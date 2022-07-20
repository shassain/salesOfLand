<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordenadas extends Model
{
    protected $fillable=["terreno_id","posy","posx"];
}
