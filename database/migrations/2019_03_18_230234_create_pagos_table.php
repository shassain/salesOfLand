<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->date("fecha");
            $table->integer("numero");
            $table->double("interes")->default(0);
            $table->double("abono_capital")->default(0);
            $table->double("valor_cuota")->default(0);
            $table->double("saldo_capital")->default(0);
            $table->double("pronto_pago")->default(0);
            $table->double("multa")->default(0);
            $table->enum("estado",["Por Pagar","Cancelado"]);
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
        Schema::dropIfExists('pagos');
    }
}
