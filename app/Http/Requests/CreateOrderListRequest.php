<?php

namespace App\Http\Requests;

use App\OrderList;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderListRequest extends FormRequest
{
    protected $errorBag = 'create';

    public function authorize()
    {
        return $this->user()->can('create', OrderList::class);
    }

    public function rules()
    {
        return [
            'note' => 'required|string|max:255',
            'kitchen_id' => 'required|exists:users,id'
        ];
    }
}
