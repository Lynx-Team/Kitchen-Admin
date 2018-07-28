<?php

namespace App\Http\Requests;

use App\Supplier;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends CreateSupplierRequest
{
    public function authorize()
    {
        return $this->user()->can('update', Supplier::find($this->id));
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255'
        ];
    }
}
