<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProntoPago extends Model
{
    protected $fillable=["nombre","dias","monto","porciento","pordia"];
}
