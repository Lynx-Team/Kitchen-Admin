<?php

namespace App\Http\Requests;

use App\AvailableItem;
use Illuminate\Foundation\Http\FormRequest;

class CreateAvailableItemRequest extends FormRequest
{
    protected $errorBag = 'create';

    public function authorize()
    {
        return $this->user()->can('create', AvailableItem::class);
    }

    public function rules()
    {
        return [
            'order_list_id' => 'required|exists:order_lists,id',
            'item_id' => 'required|exists:items,id'
        ];
    }
}
