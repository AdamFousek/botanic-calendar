<?php

namespace App\Http\Controllers;

use App\Http\Requests\Group\InviteMemberRequest;
use App\Http\Requests\Group\StoreGroupRequest;
use App\Http\Requests\Group\UpdateGroupRequest;
use App\Models\Group;
use App\Queries\Group\ViewGroup;
use App\Queries\Group\ViewGroupHandler;
use App\Queries\Group\ViewGroupMembers;
use App\Queries\Group\ViewGroupMembersHandler;
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

    public function inviteMember(InviteMemberRequest $request, Group $group)
    {
        $validated = $request->validated();

        return redirect()->back()->with('success', 'Invitation sent!');
    }
}
