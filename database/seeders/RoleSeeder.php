<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'nombre' => 'admin',
                'descripcion' => 'Administrador',
            ],
            [
                'nombre' => 'banobras',
                'descripcion' => 'Banobras',
            ],
            [
                'nombre' => 'analista',
                'descripcion' => 'Analista Auditor',
            ],
            [
                'nombre' => 'super_admin',
                'descripcion' => 'Super Usuario',
            ]
        ]);
    }
}
