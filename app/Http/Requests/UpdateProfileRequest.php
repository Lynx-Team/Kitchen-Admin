<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class UpdateProfileRequest extends FormRequest
{
    protected $errorBag = 'profile';

    public function authorize()
    {
        return $this->user()->can('update_profile', User::find($this->id));
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->id
        ];
    }
}
