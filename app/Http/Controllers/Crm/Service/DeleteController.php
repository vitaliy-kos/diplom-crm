<?php

namespace App\Http\Controllers\Crm\Service;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke(Service $service)
    {
        $service->delete();

        CreateLog::add($service, Route::currentRouteAction(), '');

        return redirect()->route('crm.service.index');
    }
}
