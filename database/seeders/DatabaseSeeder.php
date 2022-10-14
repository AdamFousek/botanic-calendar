<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
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

         Project::factory()->count(random_int(2, 6))->for($admin)->create();
         Group::factory()->count(random_int(2,6))->for($admin)->create();

        $users = User::factory(random_int(5, 10))->create();
        foreach ($users as $user) {
            Project::factory()->count(random_int(0,4))->for($user)->create();
            Group::factory()->count(random_int(0,4))->for($user)->create();
        }
    }
}
