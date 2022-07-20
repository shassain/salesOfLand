<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nombre");
            $table->text("descripcion");
            $table->text("lista");//lista de veneficios y otros
            $table->string("posx",32);
            $table->string("posy",32);
            $table->integer("zoom")->default(17);
            $table->integer("zoom_min")->default(17);
            $table->integer("zoom_max")->default(17);
            $table->string("lugar")->default("COTOCA");
            $table->string("alcaldia")->default("COTOCA");
            $table->timestamps();
        });
        Schema::create('pyp', function (Blueprint $table) {
            $table->integer("proyecto_id")->unsigned();
            $table->integer("caracteristica_id")->unsigned();
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
        Schema::dropIfExists('pyp');
        Schema::dropIfExists('proyectos');
    }
}

