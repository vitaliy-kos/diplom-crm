<?php

namespace App\Http\Controllers\Crm\MetroStation;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\MetroStation;

class ShowController extends Controller
{
    public function __invoke(MetroStation $metroStation)
    {
        $logs = GetLog::getAll($metroStation);

        return view('crm.metroStation.show', compact('metroStation', 'logs'));
    }
}
