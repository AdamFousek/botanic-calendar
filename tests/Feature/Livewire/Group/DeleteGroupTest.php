<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire\Group;

use App\Command\Group\InsertGroupCommand;
use App\Command\Group\InsertGroupHandler;
use App\Http\Livewire\Group\Forms\DeleteGroup;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteGroupTest extends TestCase
{
    protected InsertGroupHandler $insertGroupHandler;

    public function setUp(): void
    {
        parent::setUp();

        $this->insertGroupHandler = $this->app->make(InsertGroupHandler::class);
    }

    public function test_can_delete_project(): void
    {
        $user = User::factory()->create();
        $group = $this->createGroup($user);

        $this->actingAs($user);
        Livewire::test(DeleteGroup::class, ['uuid' => $group->uuid])
            ->call('delete');

        $deletedGroup = Group::withTrashed()->where('uuid', $group->uuid)->first();

        $this->assertTrue($deletedGroup->trashed());
    }

    public function test_can_not_delete_project(): void
    {
        $user = User::factory()->create();
        $group = $this->createGroup($user);

        $user2 = User::factory()->create();
        $this->actingAs($user2);
        Livewire::test(DeleteGroup::class, ['uuid' => $group->uuid])
            ->call('delete')
            ->assertForbidden();

        $deletedGroup = Group::withTrashed()->where('uuid', $group->uuid)->first();

        $this->assertNotTrue($deletedGroup->trashed());
    }

    private function createGroup($user): Group
    {
        return $this->insertGroupHandler->handle(new InsertGroupCommand(
            'New Group',
            (string) Str::uuid(),
            true,
            'New group description',
            $user->id,
        ));
    }
}
