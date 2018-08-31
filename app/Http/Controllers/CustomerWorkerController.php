<?php
/**
 * Created by PhpStorm.
 * User: keltar
 * Date: 31.08.18
 * Time: 21:17
 */

namespace App\Http\Controllers;


use App\CustomerWorker;
use App\Http\Requests\CreateCustomerWorkerRequest;

class CustomerWorkerController
{
    public function create(CreateCustomerWorkerRequest $request)
    {
        CustomerWorker::create($request->all());
        return redirect()->back();
    }


    public function delete(Request $request)
    {
        $customerWorker = CustomerWorker::findOrFail($request->id);
        if (Auth::user()->can('delete', $customerWorker))
            $customerWorker->delete();

        return redirect()->back();
    }
}