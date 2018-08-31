<?php
/**
 * Created by PhpStorm.
 * User: keltar
 * Date: 31.08.18
 * Time: 20:41
 */

namespace App\Http\Controllers;


use App\Http\Requests\CreateKitchenProfileRequest;
use App\Http\Requests\UpdateKitchenProfileRequest;
use App\KitchenProfile;

class KitchenProfileController
{
    public function create(CreateKitchenProfileRequest $request)
    {
        KitchenProfile::create($request->all());
        return redirect()->back();
    }

    public function update(UpdateKitchenProfileRequest $request)
    {
        KitchenProfile::find($request->id)->update($request->all());
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $kitchenProfile = KitchenProfile::findOrFail($request->id);
        if (Auth::user()->can('delete', $kitchenProfile))
            $kitchenProfile->delete();

        return redirect()->back();
    }
}