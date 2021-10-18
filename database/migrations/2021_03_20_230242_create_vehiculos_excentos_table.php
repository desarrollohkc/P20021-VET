<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosExcentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos_excentos', function (Blueprint $table) {
            $table->id();
            $table->string('marca');
            $table->string('submarca');
            $table->year('year');
            $table->string('numero_de_serie');
            $table->string('placa');
            $table->string('tag_id');
            $table->string('color');
            $table->string('descripcion_uso');

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
        Schema::dropIfExists('vehiculos_excentos');
    }
}
