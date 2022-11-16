<?php

namespace App\Http\Livewire\Group\Pages;

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
        $userId = Auth::id();
        $search = trim($this->searchText);

        $groups = $viewGroupsHandler->handle(new ViewGroupsQuery(
            $userId,
            $search !== '' ? $search : null,
        ));

        return view('livewire.group.pages.my-groups', [
            'groups' => $groupTransformer->transformMulti($groups),
        ]);
    }
}
