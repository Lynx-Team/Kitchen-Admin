<?php

namespace App\Http\Controllers;

use App\CustomerWorker;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateUserRequest;
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
        if (Auth::check() && Auth::user()->can('view', User::class))
        {
            $roles = Auth::user()->is_superuser ? Role::where('name', 'customer')->get()
                : Role::whereNotIn('name', ['customer', 'superuser'])->get();
            $users = Auth::user()->is_superuser ? User::whereHas('role', function ($q) {
                $q->where('name', 'customer');
            })->get() : User::whereHas('role', function ($q) {
                $q->whereNotIn('name', ['customer', 'superuser']);
            })->whereHas('worker', function ($q) {
                $q->where('customer_id', Auth::user()->customer()->id);
            })->get();
            return view('pages.users', ['users' => $users, 'roles' => $roles]);
        }
        return redirect()->back();
    }

    public function create(CreateUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
        ]);
        $role = Role::findOrFail($request->role)->name;
        CustomerWorker::create([
           'customer_id' => $role == 'customer' ? $user->id : Auth::user()->customer()->id,
           'worker_id' => $user->id
        ]);
        return redirect()->back();
    }

    public function update(UpdateUserRequest $request)
    {
        User::find($request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role
        ]);
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $userToDelete = User::findOrFail($request->id);
        if (Auth::user()->can('delete', $userToDelete))
            $userToDelete->delete();

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
