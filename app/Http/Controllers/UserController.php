<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function indexowner()
    {
        $users = User::where('role_id',2)->get();
        $roles = Role::get()->get();
        return view();
    }
}
