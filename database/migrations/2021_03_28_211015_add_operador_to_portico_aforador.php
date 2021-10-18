<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOperadorToPorticoAforador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portico_aforadors', function (Blueprint $table) {
            $table->string('operador')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('portico_aforadors', function (Blueprint $table) {
            Schema::dropColumns('operador');
            Schema::dropColumns('user_id');
        });
    }
}
