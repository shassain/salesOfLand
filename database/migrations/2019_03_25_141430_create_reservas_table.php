<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->date("fecha_reserva");
            $table->date("fecha_limite");
            $table->string("condicion_venta");
            $table->integer("user_id");
            $table->string("grupo");
            $table->string("oficina");
            $table->text("observacion");
            $table->integer("cliente_id");
            $table->integer("terreno_id");
            $table->integer("cuota_inicial");
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
        Schema::dropIfExists('reservas');
    }
}
