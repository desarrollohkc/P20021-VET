<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Sergio',
                'email' => 'sergio@gmail.com',
                'password' => Hash::make('hola'),
                'role_id' => Roles::where('nombre','super_admin')->first()->id,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ]
        ]);
    }
}
