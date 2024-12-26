<?php

namespace App\Http\Controllers\Crm\Status;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\Status;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke(Status $status)
    {
        $status->delete();

        CreateLog::add($status, Route::currentRouteAction(), '');

        return redirect()->route('crm.status.index');
    }
}
