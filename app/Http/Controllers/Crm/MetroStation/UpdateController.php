<?php

namespace App\Http\Controllers\Crm\MetroStation;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\MetroStation\UpdateRequest;
use App\Models\MetroStation;
use Illuminate\Support\Facades\Route;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, MetroStation $metroStation)
    {
        $data = $request->validated();
        $metroStation->update($data);

        CreateLog::add($metroStation, Route::currentRouteAction(), '');

        return view('crm.metroStation.show', compact('metroStation'));
    }
}
