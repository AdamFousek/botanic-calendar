<?php

namespace App\Http\Controllers;

use App\Command\Group\ViewGroup;
use App\Command\Group\ViewGroupHandler;
use App\Command\Group\ViewGroupMembers;
use App\Command\Group\ViewGroupMembersHandler;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function __construct(
        private readonly ViewGroupHandler $viewGroupHandler,
        private readonly ViewGroupMembersHandler $viewGroupMembersHandler,
    ) {
    }

    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $userId = Auth::id();

        $groups = $this->viewGroupHandler->handle(new ViewGroup(
            userId: $userId,
            query: $search,
        ));

        $data = [
            'groups' => $groups,
            'searchQuery' => $search,
        ];

        return view('groups.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(StoreGroupRequest $request)
    {
        //
    }

    public function show(Group $group)
    {
        $this->authorize('view', $group);

        $members = $this->viewGroupMembersHandler->handle(new ViewGroupMembers($group->id));

        $data = [
            'members' => $members,
            'group' => $group,
        ];

        return view('groups.show', $data);
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

    public function inviteMember(Group $group)
    {
        $this->authorize('inviteMember', $group);
    }
}
