<?php

namespace App\Http\Requests;

use App\Item;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    protected $errorBag = 'update';

    public function authorize()
    {
        return $this->user()->can('update', Item::find($this->id));
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:items,id',
            'short_name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'default_supplier' => 'required|exists:suppliers,id',
            'category' => 'required|exists:item_categories,id',
            'cost' => 'required|int|min:0'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $validator->getMessageBag()->add('row_id', $this->id);
        parent::failedValidation($validator);
    }
}
