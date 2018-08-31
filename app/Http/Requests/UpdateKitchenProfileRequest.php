<?php

namespace App\Http\Requests;

use App\KitchenProfile;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateKitchenProfileRequest extends FormRequest
{
    protected $errorBag = 'update';

    public function authorize()
    {
        return $this->user()->can('update', KitchenProfile::find($this->id));
    }

    public function rules()
    {
        return [
            'kitchen_id' => 'required|exists:users,id',
            'company_name' => 'string|max:200',
            'contact_name' => 'string|max:200',
            'postal_address' => 'string|max:1024',
            'delivery_address' => 'string|max:1024',
            'phone' => 'string|max:50',
            'delivery_instructions' => 'string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $validator->getMessageBag()->add('row_id', $this->id);
        parent::failedValidation($validator);
    }
}
