<?php

namespace App\Http\Controllers\Crm\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\User;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke(User $user)
    {
        $user->delete();

        CreateLog::add($user, Route::currentRouteAction(), '');

        return redirect()->route('crm.user.index');
    }
}
