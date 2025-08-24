<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'miquel',
            'email' => 'miquelgg@gmail.com',
            'password' => bcrypt('frodo123'),
        ]);

        User::create([
            'name'     => 'Jordi Granadal Mancebo',
            'email'    => 'jordi@visualnet.tk',
            'password' => bcrypt('rufito123'),
        ]);

        User::create([
            'name'     => 'Marta Granadal Mancebo',
            'email'    => 'marta@visualnet.tk',
            'password' => bcrypt('rufito123'),
        ]);

        User::factory(5)->create();       
    }
}
