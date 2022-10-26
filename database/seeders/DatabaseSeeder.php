<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        // TODO - need fix - creating groups
        Project::factory()->count(random_int(2, 6))->for($admin)->create();
        $groups = Group::factory()->count(random_int(2, 6))->for($admin)->create();

        foreach ($groups as $group) {
            DB::table('group_members')->insert(
                [
                    'user_id' => $admin->id,
                    'group_id' => $group->id,
                    'is_admin'=> true,
                ]
            );
        }

        $randomUsers = random_int(5, 10);
        $users = User::factory($randomUsers)->create();
        foreach ($users as $user) {
            Project::factory()->count(random_int(0, 4))->for($user)->create();
            $groups = Group::factory()->count(random_int(0, 4))->for($user)->create();
            foreach ($groups as $group) {
                DB::table('group_members')->insert(
                    [
                        'user_id' => $user->id,
                        'group_id' => $group->id,
                        'is_admin'=> true,
                    ]
                );
            }
        }

        for ($i = 0; $i < $randomUsers; $i++) {
            DB::table('group_members')->insertOrIgnore(
                [
                    'user_id' => User::select('id')->orderByRaw('RAND()')->first()->id,
                    'group_id' => Group::select('id')->orderByRaw('RAND()')->first()->id,
                    'is_admin' => false,
                ]
            );
        }
    }
}
