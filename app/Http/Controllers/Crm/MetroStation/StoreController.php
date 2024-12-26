<?php

namespace App\Http\Controllers\Crm\MetroStation;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\MetroStation\StoreRequest;
use App\Models\MetroStation;
use Illuminate\Support\Facades\Route;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $metroStation = MetroStation::firstOrCreate($data);

        CreateLog::add($metroStation, Route::currentRouteAction(), '');

        return redirect()->route('crm.metroStation.index');
    }
}
