<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multa extends Model
{
    protected $fillable=["nombre","dias","monto","porciento","pordia"];
}
