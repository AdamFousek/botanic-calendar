<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Transformers\Models\UserTransformer;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(
        private readonly UserTransformer $userTransformer,
    ) {
    }

    public function index()
    {
        return view('pages.users.index');
    }

    public function show(User $user)
    {
        $loggedUser = Auth::user();

        $data = [
            'user' => $this->userTransformer->transform($user),
            'canEditUser' => $loggedUser?->can('update', $user) ?? false,
        ];

        return view('pages.users.show', $data);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $data = [
            'user' => $this->userTransformer->transform($user),
        ];

        return view('pages.users.edit', $data);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
