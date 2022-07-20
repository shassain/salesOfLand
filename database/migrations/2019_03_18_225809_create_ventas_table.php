<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->enum("tipo_pago",["espera","contado","plazo"]);
            $table->integer("cliente_id")->unsigned();
            $table->integer("user_id")->unsigned();
            $table->integer("terreno_id")->unsigned();
            $table->date("fecha");
            $table->double("cuota_inicial")->default(0);
            $table->double("valor_terreno")->default(0);
            $table->integer("cantidad_cuotas")->default(0);
            $table->double("tasa_interes")->default(0);
            $table->enum("tipo_tasa",["mensual","anual"]);
            $table->enum("periodo_pago",["diario","semanal","quincenal","mensual","bimestral","trimestral","cuatrimestral","semestral","anual"]);
            $table->enum("estado",["en proceso","anulado","culminadado"]);
            $table->integer("pronto_pago_id")->unsigned();
            $table->integer("multa_id")->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
