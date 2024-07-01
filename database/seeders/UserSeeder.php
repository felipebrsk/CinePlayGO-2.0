<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(20)->create();

        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => 'admin1234',
            'email' => 'admin@gmail.com',
        ]);
    }
}
