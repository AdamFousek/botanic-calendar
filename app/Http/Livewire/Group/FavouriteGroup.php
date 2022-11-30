<?php

namespace App\Http\Livewire\Group;

use App\Command\Group\ToggleFavouriteGroupCommand;
use App\Command\Group\ToggleFavouriteGroupHandler;
use App\Models\Group;
use App\Models\User;
use App\Queries\Group\ViewGroupByUuidHandler;
use App\Queries\Group\ViewGroupByUuidQuery;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FavouriteGroup extends Component
{
    public bool $isFavourite = true;

    public string $uuid;

    public User $user;

    public Group $group;

    public function mount(ViewGroupByUuidHandler $viewGroupByUuidHandler): void
    {
        $this->user = Auth::user();
        $this->group = $viewGroupByUuidHandler->handle(new ViewGroupByUuidQuery($this->uuid));
        $this->isFavourite = $this->user
            ->memberGroups()
            ->where('id', $this->group->id)
            ->withPivotValue('is_favourite', true)
            ->exists();
    }

    public function toggleFavourite(
        ToggleFavouriteGroupHandler $toggleFavouriteGroupHandler
    ): void {
        $toggleFavouriteGroupHandler->handle(new ToggleFavouriteGroupCommand(
            $this->user,
            $this->group,
            $this->isFavourite,
        ));

        if (! $this->isFavourite) {
            $message = trans('Project mark as favourite');
        } else {
            $message = trans('Project removed from favourite');
        }

        redirect(route('groups.show', $this->group))->with('success', $message);
    }
}
