<?php

namespace App\Http\Livewire\Group\Components;

use App\Models\Group;
use App\Models\User;
use App\Queries\User\ViewGroupsHandler;
use App\Queries\User\ViewGroupsQuery;
use App\Transformers\Models\GroupTransformer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyGroups extends Component
{
    public string $searchText = '';

    public function render(
        GroupTransformer $groupTransformer,
        ViewGroupsHandler $viewGroupsHandler,
    ) {
        $user = Auth::user();
        if (! $user instanceof User) {
            return redirect()->route('welcome');
        }

        $search = trim($this->searchText);

        $groups = $viewGroupsHandler->handle(new ViewGroupsQuery(
            $user,
            $search !== '' ? $search : null,
        ));

        [$favouriteGroups, $groups] = $groups->partition(function (Group $group) {
            return $group->pivot->is_favourite;
        });

        return view('livewire.group.components.my-groups', [
            'groups' => $groups,
            'favouriteGroups' => $favouriteGroups,
        ]);
    }
}
