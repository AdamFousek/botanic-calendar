<?php

declare(strict_types=1);

namespace Tests\Feature\Pages\Group;

use App\Http\Livewire\Group\Forms\CreateGroup;
use App\Models\Group;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class MyGroupsTest extends TestCase
{
    public function test_can_see_create_button(): void
    {
        $user = $this->getUser();

        $this->actingAs($user);
        $response = $this->get(route('groups.index'));

        $response->assertSee('Create group');
    }

    public function test_can_see_favourite_group(): void
    {
        $user = $this->getUser();

        $this->actingAs($user);
        $response = Livewire::test(CreateGroup::class)
            ->set('group.name', 'My group')
            ->set('group.is_public', false)
            ->call('create');

        $group = Group::latest('id')->first();
        $response->assertRedirect(route('groups.show', $group));

        $group->members()->updateExistingPivot($user->id, ['is_favourite' => true]);

        $response = $this->get(route('groups.index'));
        $response->assertSee('Favourite groups');
    }

    private function getUser(): User
    {
        return User::first() ?? User::factory()->create();
    }
}
