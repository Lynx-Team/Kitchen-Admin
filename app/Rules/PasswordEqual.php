<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class PasswordEqual implements Rule
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function passes($attribute, $value)
    {
        return Hash::check($value, $this->user->password);
    }

    public function message()
    {
        return 'Invalid :attribute.';
    }
}
