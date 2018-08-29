<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMailConfigRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->is_superuser;
    }

    public function rules()
    {
        return [
            'driver' => 'required|string',
            'host' => 'required|string',
            'port' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'encryption' => 'required|string',
        ];
    }
}
