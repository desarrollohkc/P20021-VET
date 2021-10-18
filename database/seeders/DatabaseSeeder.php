<?php

namespace Database\Seeders;

use App\Models\PorticoAforador;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            TarifasSeeder::class,
            UserSeeder::class,
        ]);

        /*PorticoAforador::factory()->count(120000)->create();*/
    }
}
