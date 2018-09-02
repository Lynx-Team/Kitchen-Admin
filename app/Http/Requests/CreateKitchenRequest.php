<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateKitchenRequest extends FormRequest
{
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
            'company_name' => 'string|max:200',
            'contact_name' => 'string|max:200',
            'postal_address' => 'string|max:1024',
            'delivery_address' => 'string|max:1024',
            'phone' => 'string|max:50',
            'delivery_instructions' => 'string',
        ];
    }
}
