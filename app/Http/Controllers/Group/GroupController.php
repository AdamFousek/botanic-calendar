<?php

declare(strict_types=1);

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Queries\User\ViewGroupsHandler;
use App\Queries\User\ViewGroupsQuery;
use App\Transformers\Models\GroupTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function __construct(
        private readonly ViewGroupsHandler $viewGroupsHandler,
        private readonly GroupTransformer $groupTransformer,
    ) {
    }

    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $userId = Auth::id();

        $groups = $this->viewGroupsHandler->handle(new ViewGroupsQuery(
            $userId,
        ));

        $data = [
            'groups' => $this->groupTransformer->transformMulti($groups),
            'searchQuery' => $search,
        ];

        return view('pages.groups.index', $data);
    }

    public function create()
    {
        return view('pages.groups.create');
    }

    public function show(Group $group)
    {
        $this->authorize('view', $group);

        $data = [
            'group' => $this->groupTransformer->transform($group),
        ];

        return view('pages.groups.show', $data);
    }

    public function edit(Group $group)
    {
        $this->authorize('edit', $group);

        $data = [
            'group' => $this->groupTransformer->transform($group),
        ];

        return view('pages.groups.edit', $data);
    }
}
