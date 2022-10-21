<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Transformers\Models\GroupTransformer;
use App\Transformers\Models\ProjectTransformer;
use App\Transformers\Models\UserTransformer;

class UserController extends Controller
{
    public function __construct(
        private readonly UserTransformer $userTransformer,
        private readonly GroupTransformer $groupTransformer,
        private readonly ProjectTransformer $projectTransformer,
    ) {
    }

    public function index()
    {
        return view('users.index');
    }

    public function show(User $user)
    {
        $data = [
            'user' => $this->userTransformer->transform($user),
        ];

        return view('users.show', $data);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', ['user' => $user]);
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
