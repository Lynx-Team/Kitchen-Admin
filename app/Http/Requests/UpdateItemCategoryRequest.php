<?php

namespace App\Http\Requests;

use App\ItemCategory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateItemCategoryRequest extends FormRequest
{
    protected $errorBag = 'update';

    public function authorize()
    {
        return $this->user()->can('update', ItemCategory::find($this->id));
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:item_categories,id',
            'name' => 'required|string|max:255'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $validator->getMessageBag()->add('row_id', $this->id);
        parent::failedValidation($validator);
    }
}
