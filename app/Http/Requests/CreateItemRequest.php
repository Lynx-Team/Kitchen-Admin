<?php

namespace App\Http\Requests;

use App\Item;
use Illuminate\Foundation\Http\FormRequest;

class CreateItemRequest extends FormRequest
{
    protected $errorBag = 'create';

    public function authorize()
    {
        return $this->user()->can('create', Item::class);
    }

    public function rules()
    {
        return [
            'short_name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'default_supplier' => 'required|exists:suppliers,id',
            'category' => 'required|exists:item_categories,id',
            'cost' => 'required|numeric|min:0',
            'kitchen_id' => 'required|exists:users,id',
            'product_code' => 'required|string|max:100',
            'unit' => 'required|string|max:100',
        ];
    }
}
