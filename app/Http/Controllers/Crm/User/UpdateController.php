<?php

namespace App\Http\Controllers\Crm\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\User\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Route;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);

        CreateLog::add($user, Route::currentRouteAction(), '');

        $roles = User::getRoles();

        return view('crm.user.show', compact('roles', 'user' ));
    }
}
