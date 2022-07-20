<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProntoPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pronto_pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nombre");
            $table->integer("dias")->default(1);
            $table->double("monto")->default(0);
            $table->boolean("porciento")->default(false);
            $table->boolean("pordia")->default(false);
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
        Schema::dropIfExists('pronto_pagos');
    }
}

