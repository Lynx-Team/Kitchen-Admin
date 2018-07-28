<?php

namespace App\Http\Requests;

use App\Supplier;
use Illuminate\Contracts\Validation\Validator;

class UpdateSupplierRequest extends CreateSupplierRequest
{
    protected $errorBag = 'update_supplier';

    public function authorize()
    {
        return $this->user()->can('update', Supplier::find($this->id));
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:suppliers,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:suppliers,email,' . $this->id
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $validator->getMessageBag()->add('row_id', $this->id);
        parent::failedValidation($validator);
    }
}
