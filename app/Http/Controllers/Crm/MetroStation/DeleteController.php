<?php

namespace App\Http\Controllers\Crm\MetroStation;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\MetroStation;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke(MetroStation $metroStation)
    {
        $metroStation->delete();

        CreateLog::add($metroStation, Route::currentRouteAction(), '');

        return redirect()->route('crm.metroStation.index');
    }
}
