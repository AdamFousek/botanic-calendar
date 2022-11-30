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
use App\Transformers\Helpers\MembersTransformer;
use App\Transformers\Models\GroupTransformer;
use App\Transformers\Models\ProjectTransformer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly GroupTransformer $groupTransformer,
        private readonly AcceptInvitationHandler $acceptInvitationHandler,
        private readonly MembersTransformer $membersTransformer,
        private readonly ProjectTransformer $projectTransformer,
    ) {
    }

    public function create()
    {
        return view('pages.groups.create');
    }

    public function edit(Group $group)
    {
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
