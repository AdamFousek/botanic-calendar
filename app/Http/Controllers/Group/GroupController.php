<?php

declare(strict_types=1);

namespace App\Http\Controllers\Group;

use App\Command\Invitation\AcceptInvitationCommand;
use App\Command\Invitation\AcceptInvitationHandler;
use App\Http\Controllers\Controller;
use App\Http\Exceptions\Invitation\ForbiddenInvitationException;
use App\Http\Exceptions\Invitation\InvalidInvitationException;
use App\Models\Group;
use App\Models\Invitation;
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
        private readonly AcceptInvitationHandler $acceptInvitationHandler,
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

        $user = Auth::user();

        $data = [
            'group' => $this->groupTransformer->transform($group),
            'canInviteMember' => $user?->can('inviteMember', $group) ?? false,
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

    public function acceptInvitation(Group $group, Invitation $invitation)
    {
        $user = Auth::user();
        try {
            $this->acceptInvitationHandler->handle(new AcceptInvitationCommand(
                $user,
                $group,
                $invitation,
            ));
        } catch (InvalidInvitationException) {
            return redirect(route('groups.index'))->with('error', trans('Invitation expired. Please ask for new one.'));
        } catch (ForbiddenInvitationException) {
            abort(404);
        }

        return redirect(route('groups.show', $group));
    }
}
