<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imgproyect extends Model
{
    protected $fillable=["proyecto_id","url","base64","mini","posy","posx","enmapa","w","h","xminimo","xmaximo","yminimo","ymaximo","opacity","rotate"];
    
}
