<?php

namespace App\Http\Controllers\Crm\Service;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Service\StoreRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $service = Service::firstOrCreate($data);

        CreateLog::add($service, Route::currentRouteAction(), '');


        return redirect()->route('crm.service.index');
    }
}
