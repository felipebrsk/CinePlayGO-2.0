<?php

namespace Database\Seeders;

use App\Models\User;
use App\Jobs\RegisterUserJob;
use App\Services\TitleService;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titleService = new TitleService();

        User::factory(20)->create()->each(function (User $user) use ($titleService) {
            RegisterUserJob::dispatch($user, $titleService);
        });

        $user = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => 'admin1234',
            'email' => 'admin@gmail.com',
        ]);

        RegisterUserJob::dispatch($user, $titleService);
    }
}
