<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function update(Request $request)
    {
        User::where('id', $request->id)->update(['name' => $request->name, 'email' => $request->email,
            'role_id' => $request->role]);
        
        return redirect()->route('users.view');
    }

    public function delete(Request $request)
    {
        User::where('id', $request->id)->delete();
        return redirect()->route('users.view');
    }
}
