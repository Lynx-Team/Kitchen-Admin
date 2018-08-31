<?php
/**
 * Created by PhpStorm.
 * User: keltar
 * Date: 31.08.18
 * Time: 21:18
 */

namespace App\Http\Requests;


use App\CustomerWorker;

class CreateCustomerWorkerRequest
{
    protected $errorBag = 'create';

    public function authorize()
    {
        return $this->user()->can('create', CustomerWorker::class);
    }

    public function rules()
    {
        return [
            'customer_id' => 'required|exists:users,id',
            'worker_id' => 'required|exists:users,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $validator->getMessageBag()->add('row_id', $this->id);
        parent::failedValidation($validator);
    }
}