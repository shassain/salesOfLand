<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImgproyectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imgproyects', function (Blueprint $table) {
            $table->increments('id');
            $table->string("url");
            $table->longText("base64");
            $table->string("mini");
            $table->string("posx",32);
            $table->string("posy",32);
            $table->boolean("enmapa")->default(false);
            $table->boolean("promocional")->default(false);
            $table->double("w")->default(0.500);
            $table->double("h")->default(0.520);
            $table->double("xminimo")->default(0.0);
            $table->double("xmaximo")->default(0.0);
            $table->double("yminimo")->default(0.0);
            $table->double("ymaximo")->default(0.0);
            $table->double("opacity")->default(0.5);
            $table->double("rotate")->default(0.0);    
            $table->integer("proyecto_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imgproyects');
    }
}

