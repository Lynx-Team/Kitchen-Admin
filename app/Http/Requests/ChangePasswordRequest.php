<?php

namespace App\Http\Requests;

use App\Rules\PasswordEqual;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    protected $errorBag = 'change_password';

    public function authorize()
    {
        return $this->user()->can('change_password', User::find($this->id));
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:users,id',
            'old_password' => ['required', 'string', 'min:4', new PasswordEqual(User::find($this->id))],
            'new_password' => 'required|string|min:4'
        ];
    }
}
