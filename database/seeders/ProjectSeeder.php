<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all()->random(random_int(30, 50));

        /** @var User $user */
        foreach ($users as $user) {
            $projects = Project::factory()->count(random_int(2, 5))->create([
                'user_id' => $user,
                'group_id' => random_int(0, 1) ? $user->groups->random(1)->value('id') : null,
            ]);

            /** @var Project $project */
            foreach ($projects as $project) {
                if ($project->users()->isEmpty()) {
                    continue;
                }

                $groupUsers = $project->users()->random(random_int(0, $project->users()->count()));

                foreach ($groupUsers as $groupUser) {
                    if ($groupUser->id !== $user->id && random_int(0, 1)) {
                        DB::table('favourite_projects')->insert([
                            'user_id' => $groupUser->id,
                            'project_id' => $project->id,
                        ]);
                    }
                }
            }
        }
    }
}
