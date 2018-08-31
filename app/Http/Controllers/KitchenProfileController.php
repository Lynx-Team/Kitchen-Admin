<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKitchenProfileRequest;
use App\Http\Requests\UpdateKitchenProfileRequest;
use App\KitchenProfile;
use Illuminate\Support\Facades\Auth;

class KitchenProfileController
{
    public function view($id)
    {
        if (Auth::check() && Auth::user()->can('view', KitchenProfile::class))
        {
            $kitchenProfile = KitchenProfile::where('kitchen_id', $id)->with('kitchen')->get();
            return view('pages.kitchen_profile', ['kitchenProfile' => $kitchenProfile[0]]);
        }
        return redirect()->back();
    }

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
}