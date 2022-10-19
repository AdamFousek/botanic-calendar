<?php

namespace App\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;

class InviteMemberRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('inviteMember', $this->group);
    }

    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email'],
        ];
    }
}
