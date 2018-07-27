<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
        if (Auth::user()->can('view', User::class))
        {
            $roles = Role::all();
            return view('pages.users', ['users' => User::all(), 'roles' => $roles]);
        }

        return redirect()->back();
    }

    public function create(Request $request)
    {
        if (Auth::user()->can('create', User::class))
        {
            User::updateOrCreate(['email' => $request->email], [
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'role_id' => $request->role,
            ]);

            return redirect()->back();
        }

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $userToUpdate = User::where('id', $request->id)->firstOrFail();

        if (Auth::user()->can('update', $userToUpdate))
        {
            User::where('id', $request->id)->update(['name' => $request->name, 'email' => $request->email,
                'role_id' => $request->role]);

            return redirect()->back();
        }

        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $userToDelete = User::where('id', $request->id)->firstOrFail();

        if (Auth::user()->can('delete', $userToDelete))
        {
            User::where('id', $request->id)->delete();
            return redirect()->back();
        }

        return redirect()->back();
    }

    public function update_profile(UpdateProfileRequest $request)
    {
        User::find($request->id)->update(['name' => $request->name, 'email' => $request->email]);
        return redirect()->back();
    }

    public function change_password(ChangePasswordRequest $request)
    {
        User::find($request->id)->update(['password' => Hash::make($request->new_password)]);
        return redirect()->back();
    }
}
