<?php

namespace App\Http\Controllers;

use App\User;
use App\UserTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view() {
        if (Auth::user()->can('view', User::class))
            return view('pages.users', ['users' => User::all()]);

        return view('errors.403');
    }

    public function update(Request $request) {

        return $this->view();
    }
}
