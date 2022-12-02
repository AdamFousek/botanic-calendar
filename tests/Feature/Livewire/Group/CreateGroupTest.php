<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire\Group;

use App\Http\Livewire\Group\Forms\CreateGroup;
use App\Models\Group;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class CreateGroupTest extends TestCase
{
    public function test_can_create_project(): void
    {
        $this->actingAs(User::factory()->create());

        $name = 'Lorem project';
        Livewire::test(CreateGroup::class)
            ->set('group.name', $name)
            ->set('group.description', 'Lorem ipsum')
            ->set('group.is_public', false)
            ->call('create');

        $this->assertTrue(Group::whereName($name)->exists());
    }
}
