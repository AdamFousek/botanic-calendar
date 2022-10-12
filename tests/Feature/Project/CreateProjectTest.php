<?php

namespace Tests\Feature\Project;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_project()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post('/projects/create', [
                'name' => 'Test Project',
                'is_public' => false,
            ]);

        $response->assertRedirectContains('/projects/');
    }
}
