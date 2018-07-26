<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        return view('errors.403');
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

        return view('errors.403');
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

        return view('errors.403');
    }

    public function delete(Request $request)
    {
        $userToDelete = User::where('id', $request->id)->firstOrFail();

        if (Auth::user()->can('delete', $userToDelete))
        {
            User::where('id', $request->id)->delete();
            return redirect()->back();
        }

        return view('errors.403');
    }

    public function update_profile(Request $request)
    {
        $userToUpdate = User::where('id', $request->id)->firstOrFail();
        if (Auth::user()->can('update_profile', $userToUpdate))
        {
            $userToUpdate->update(['name' => $request->name, 'email' => $request->email]);
            return redirect()->back();
        }

        return view('errors.403');
    }

    public function change_password(Request $request)
    {
        $userToChangePassword = User::where('id', $request->id)->firstOrFail();
        if (Auth::user()->can('change_password', $userToChangePassword) &&
            Hash::check($request->old_password, $userToChangePassword->password))
        {
            $userToChangePassword->update(['password' => Hash::make($request->new_password)]);
            return redirect()->back();
        }

        return view('errors.403');
    }
}
