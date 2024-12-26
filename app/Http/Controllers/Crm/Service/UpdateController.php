<?php

namespace App\Http\Controllers\Crm\Service;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Service\UpdateRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Service $service)
    {
        $data = $request->validated();
        $service->update($data);

        CreateLog::add($service, Route::currentRouteAction(), '');

        return view('crm.service.show', compact('service'));
    }
}
