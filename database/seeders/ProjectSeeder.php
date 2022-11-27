<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
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
            $projects = Project::factory()->count(random_int(3, 5))->create([
                'user_id' => $user,
                'group_id' => random_int(0, 1) ? $user->groups->random(1)->value('id') : null,
            ]);

            /** @var Project $project */
            foreach ($projects as $project) {
                $project->members()->attach($user->id, ['is_favourite' => random_int(0, 1)]);

                $groupUsers = $project->group?->members;
                if (! isset($groupUsers) || $groupUsers->isEmpty()) {
                    continue;
                }

                $groupUsers = $groupUsers->random(random_int(0, $groupUsers->count()));

                foreach ($groupUsers as $groupUser) {
                    $project->members()->attach($groupUser->id, ['is_favourite' => (bool) random_int(0, 1)]);
                }
            }
        }
    }
}
