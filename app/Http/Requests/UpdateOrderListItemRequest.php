<?php

namespace App\Http\Requests;

use App\OrderListItem;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderListItemRequest extends FormRequest
{
    protected $errorBag = 'update';

    public function authorize()
    {
        return $this->user()->can('update', OrderListItem::find($this->id));
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:order_list_items,id',
            'quantity' => 'required|integer|min:1',
            'supplier_sort_order' => 'required|integer',
            'kitchen_sort_order' => 'required|integer',
            'supplier_id' => 'required|exists:suppliers,id',
            'order_list_id' => 'required|exists:order_lists,id',
            'item_id' => 'required|exists:items,id',
            'available_item_id' => 'required|exists:available_items,id'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $validator->getMessageBag()->add('row_id', $this->id);
        parent::failedValidation($validator);
    }
}
