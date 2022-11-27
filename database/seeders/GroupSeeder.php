<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        /** @var User $user */
        foreach ($users as $user) {
            $groups = Group::factory()->count(random_int(1, 5))->create([
                'user_id' => $user->id,
            ]);

            /** @var Group $group */
            foreach ($groups as $group) {
                $group->members()->attach($user->id, [
                    'is_admin' => true,
                    'is_favourite' => false,
                ]);
            }
        }

        // Random groups
        foreach ($users as $user) {
            $groups = Group::all()->random(random_int(1, Group::all()->count()));
            foreach ($groups as $group) {
                if (! $user->groups->contains($group->id)) {
                    $group->members()->attach($user->id, [
                        'is_admin' => false,
                        'is_favourite' => (bool) random_int(0, 1),
                    ]);
                }
            }
        }
    }
}
