<?php

namespace App\Http\Controllers\Crm\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class IndexController extends Controller
{
    public function __invoke()
    {
        $roles = User::getRoles();
        $users = User::all();
        return view('crm.user.index', compact('users', 'roles'));
    }
}
