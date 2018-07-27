<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    protected $errorBag = 'create_user';

    public function authorize()
    {
        return $this->user()->can('create', User::class);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:4',
            'role' => 'required|exists:roles,id'
        ];
    }
}
