<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ci')->unique();
            $table->date('fecha_experiacion')->nullable();
            $table->string('nombre')->nullable();
            $table->string('apellidos')->nullable();
            $table->enum('genero', ['masculino', 'femenino'])->default('masculino');
            $table->date('fecha_nacimiento')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('lugar_trabajo')->nullable();
            $table->string('direccion_trabajo')->nullable();
            $table->string('ciudad')->nullable();
            $table->longText('avatar');
            $table->rememberToken();
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
        Schema::dropIfExists('clientes');
    }
}

