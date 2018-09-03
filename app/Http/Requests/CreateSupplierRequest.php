<?php

namespace App\Http\Requests;

use App\Supplier;
use Illuminate\Foundation\Http\FormRequest;

class CreateSupplierRequest extends FormRequest
{
    protected $errorBag = 'create_supplier';

    public function authorize()
    {
        return $this->user()->can('create', Supplier::class);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:suppliers,email',
            'kitchen_id' => 'required|exists:users,id',
        ];
    }
}
