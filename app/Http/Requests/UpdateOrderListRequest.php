<?php

namespace App\Http\Requests;

use App\OrderList;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderListRequest extends FormRequest
{
    protected $errorBag = 'update';

    public function authorize()
    {
        return $this->user()->can('update', OrderList::find($this->id));
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:order_lists,id',
            'note' => 'required|string|max:255',
            'kitchen' => 'required|exists:users,id',
            'completed' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $validator->getMessageBag()->add('row_id', $this->id);
        parent::failedValidation($validator);
    }
}
