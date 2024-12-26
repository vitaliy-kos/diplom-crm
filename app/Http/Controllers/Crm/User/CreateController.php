<?php

namespace App\Http\Controllers\Crm\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class CreateController extends Controller
{
    public function __invoke()
    {
        $roles = User::getRoles();
        return view('crm.user.create', compact('roles'));
    }
}
