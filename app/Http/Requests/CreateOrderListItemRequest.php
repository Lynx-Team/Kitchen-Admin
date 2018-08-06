<?php

namespace App\Http\Requests;

use App\OrderListItem;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderListItemRequest extends FormRequest
{
    protected $errorBag = 'create';

    public function authorize()
    {
        return $this->user()->can('create', OrderListItem::class);
    }

    public function rules()
    {
        return [
            'cost' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:1',
            'supplier_sort_order' => 'required|integer',
            'kitchen_sort_order' => 'required|integer',
            'supplier_id' => 'required|exists:suppliers,id',
            'order_list_id' => 'required|exists:order_lists,id',
            'item_id' => 'required|exists:items,id',
        ];
    }
}
