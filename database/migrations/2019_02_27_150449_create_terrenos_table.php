<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerrenosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terrenos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("proyecto_id");
            $table->string("manzano");
            $table->string("nro_lote");
            $table->integer("categoria_id");
            $table->double("superficie");
            $table->double("precoi_x_mtr2");
            $table->double("valor_terreno");
            $table->double("descuento_general");
            $table->double("descuento_promocion");
            $table->double("precio_venta");
            $table->enum("estado",["disponible","vendido","reservado","bloqueado"])->default("disponible");
            
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
        Schema::dropIfExists('terrenos');
    }
}
