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
use App\Queries\User\ViewUserByEmailHandler;
use App\Queries\User\ViewUserByEmailQuery;
use App\Transformers\Models\GroupTransformer;
use App\Transformers\Models\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function __construct(
        private readonly ViewGroupHandler $viewGroupHandler,
        private readonly ViewGroupMembersHandler $viewGroupMembersHandler,
        private readonly ViewUserByEmailHandler $viewUserByEmailHandler,
        private readonly GroupTransformer $groupTransformer,
        private readonly UserTransformer $userTransformer,
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
            'groups' => $this->groupTransformer->transformMulti($groups),
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
            'group' => $this->groupTransformer->transform($group),
            'members' => $this->userTransformer->transformMulti($members),
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

        $user = $this->viewUserByEmailHandler->handle(new ViewUserByEmailQuery($validated['email'] ?? ''));
        if ($user === null) {
            redirect()->back()->with('error', trans('user_doesnt_exists_in_application'));
        }

        return redirect()->back()->with('success', trans('invitation_send_successfully'));
    }
}
