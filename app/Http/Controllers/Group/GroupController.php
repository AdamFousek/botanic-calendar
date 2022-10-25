<?php

declare(strict_types=1);

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use App\Http\Requests\Group\StoreGroupRequest;
use App\Http\Requests\Group\UpdateGroupRequest;
use App\Models\Group;
use App\Queries\Group\ViewGroupHandler;
use App\Queries\Group\ViewGroupQuery;
use App\Queries\User\ViewUserByEmailHandler;
use App\Transformers\Models\GroupTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function __construct(
        private readonly ViewGroupHandler $viewGroupHandler,
        private readonly ViewUserByEmailHandler $viewUserByEmailHandler,
        private readonly GroupTransformer $groupTransformer,
    ) {
    }

    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $userId = Auth::id();

        $groups = $this->viewGroupHandler->handle(new ViewGroupQuery(
            userId: $userId,
            query: $search,
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

    public function store(StoreGroupRequest $request)
    {
        //
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
        //
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        //
    }

    public function destroy(Group $group)
    {
        //
    }
}
