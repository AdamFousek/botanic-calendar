<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Group\InviteMemberRequest;
use App\Http\Requests\Group\StoreGroupRequest;
use App\Http\Requests\Group\UpdateGroupRequest;
use App\Models\Group;
use App\Queries\Group\ViewGroupHandler;
use App\Queries\Group\ViewGroupQuery;
use App\Queries\User\ViewUserByEmailHandler;
use App\Queries\User\ViewUserByEmailQuery;
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

        return view('groups.index', $data);
    }

    public function create()
    {
        return view('groups.create');
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
