<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePorticoAforadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portico_aforadors', function (Blueprint $table) {
            $table->id();
            $table->string('tag_id')->nullable();
            $table->dateTime('fecha_ingreso');
            $table->string('carril')->nullable();
            $table->string('cuerpo')->nullable();
            $table->string('placa')->nullable();
            $table->decimal('cantidad', $precision = 5, $scale = 2);
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
        Schema::dropIfExists('portico_aforadors');
    }
}
