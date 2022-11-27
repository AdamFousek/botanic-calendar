<?php

namespace App\Http\Livewire\Project;

use App\Command\Project\MarkProjectAsFavouriteByUserHandler;
use App\Command\Project\MarkProjectFavouriteByUserCommand;
use App\Models\Project;
use App\Models\User;
use App\Queries\Project\ViewProjectByUuidHandler;
use App\Queries\Project\ViewProjectByUuidQuery;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FavouriteProject extends Component
{
    public bool $isFavourite = true;

    public string $uuid;

    public User $user;

    public Project $project;

    public function mount(ViewProjectByUuidHandler $viewProjectByUuidHandler): void
    {
        $this->user = Auth::user();
        $this->project = $viewProjectByUuidHandler->handle(new ViewProjectByUuidQuery($this->uuid));
        $this->isFavourite = $this->user
            ->memberProjects()
            ->withPivotValue('is_favourite', true)
            ->get()
            ->contains($this->project->id);
    }

    public function toggleFavourite(
        MarkProjectAsFavouriteByUserHandler $favouriteByUserHandler
    ): void {
        $favouriteByUserHandler->handle(new MarkProjectFavouriteByUserCommand(
            $this->user,
            $this->project,
            $this->isFavourite,
        ));

        if (! $this->isFavourite) {
            $message = trans('Project mark as favourite');
        } else {
            $message = trans('Project removed from favourite');
        }

        redirect(route('projects.show', $this->project))->with('success', $message);
    }
}
