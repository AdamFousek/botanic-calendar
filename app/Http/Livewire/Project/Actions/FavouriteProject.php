<?php

namespace App\Http\Livewire\Project\Actions;

use App\Command\Project\MarkProjectAsFavouriteByUserHandler;
use App\Command\Project\MarkProjectFavouriteByUserCommand;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FavouriteProject extends Component
{
    public bool $isFavourite = true;

    public Project $project;

    public User $user;

    public function mount(): void
    {
        $this->user = Auth::user();
        $this->isFavourite = $this->user
            ->memberProjects()
            ->where('id', $this->project->id)
            ->withPivotValue('is_favourite', true)
            ->exists();
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
