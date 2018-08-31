<?php
/**
 * Created by PhpStorm.
 * User: keltar
 * Date: 31.08.18
 * Time: 20:47
 */

namespace App\Http\Requests;


use App\KitchenProfile;

class CreateKitchenProfileRequest
{
    protected $errorBag = 'create';

    public function authorize()
    {
        return $this->user()->can('create', KitchenProfile::class);
    }

    public function rules()
    {
        return [
            'kitchen_id' => 'required|exists:users,id',
            'company_name' => 'required|string|max:200',
            'contact_name' => 'required|string|max:200',
            'postal_address' => 'required|string|max:1024',
            'delivery_address' => 'required|string|max:1024',
            'phone' => 'required|string|max:50',
            'delivery_instructions' => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $validator->getMessageBag()->add('row_id', $this->id);
        parent::failedValidation($validator);
    }
}