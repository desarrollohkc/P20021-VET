<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TarifasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tarifas')->insert([
            [
                'user_id' => '1',
                'cantidad' => '147.00',
                'active' => true ,
                'accion' => 'Definir tarifa',
                'tarifa_fecha_inicio' => null,
                'tarifa_fecha_fin' => null,
                'descripcion' => 'Se define tarifa desde el seeder',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
