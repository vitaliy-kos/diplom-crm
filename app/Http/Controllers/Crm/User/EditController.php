<?php

namespace App\Http\Controllers\Crm\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\User;

class EditController extends Controller
{
    public function __invoke(User $user)
    {
        $logs = GetLog::getAll($user);
        $roles = User::getRoles();
        return view('crm.user.edit', compact('user', 'roles', 'logs'));
    }
}
