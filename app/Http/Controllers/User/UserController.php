<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Transformers\Models\UserTransformer;

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
        $data = [
            'user' => $this->userTransformer->transform($user),
        ];

        return view('pages.users.show', $data);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('pages.users.edit', ['user' => $user]);
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
