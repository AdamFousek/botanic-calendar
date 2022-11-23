<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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
        $admin = User::factory()->create([
            'username' => 'adamfousek',
            'first_name' => 'Adam',
            'last_name' => 'Fousek',
            'email' => 'adamfousekdev@gmail.com',
        ]);

        $this->call([
            UserSeeder::class,
            GroupSeeder::class,
            ProjectSeeder::class,
            ExperimentSeeder::class,
        ]);
    }
}
