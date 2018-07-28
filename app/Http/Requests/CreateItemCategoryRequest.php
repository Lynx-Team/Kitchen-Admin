<?php

namespace App\Http\Requests;

use App\ItemCategory;
use Illuminate\Foundation\Http\FormRequest;

class CreateItemCategoryRequest extends FormRequest
{
    protected $errorBag = 'create';

    public function authorize()
    {
        return $this->user()->can('create', ItemCategory::class);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255'
        ];
    }
}
