<?php

declare(strict_types=1);

namespace Tests\Feature\Pages\Group;

use App\Models\User;
use Tests\TestCase;

class MyGroupsTest extends TestCase
{
    public function test_can_see_create_button(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        $response = $this->get(route('groups.index'));

        $response->assertSee('Create group');
    }
}
