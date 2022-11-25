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
use App\Models\Project;
use App\Transformers\Helpers\MembersTransformer;
use App\Transformers\Models\GroupTransformer;
use App\Transformers\Models\ProjectTransformer;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function __construct(
        private readonly GroupTransformer $groupTransformer,
        private readonly AcceptInvitationHandler $acceptInvitationHandler,
        private readonly MembersTransformer $membersTransformer,
        private readonly ProjectTransformer $projectTransformer,
    ) {
    }

    public function index()
    {
        return view('pages.groups.index');
    }

    public function create()
    {
        return view('pages.groups.create');
    }

    public function show(Group $group)
    {
        $this->authorize('view', $group);

        $user = Auth::user();

        $members = $group->members;
        $projects = $group->projects()->with(['group', 'user'])->get();

        $data = [
            'group' => $this->groupTransformer->transform($group),
            'members' => $this->membersTransformer->transform($members),
            'projects' => $this->projectTransformer->transformMulti($projects),
            'canInviteMember' => $user?->can('inviteMember', $group) ?? false,
            'canEditGroup' => $user?->can('update', $group) ?? false,
            'canCreateProject' => $user?->can('create', [Project::class, $group]) ?? false,
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
