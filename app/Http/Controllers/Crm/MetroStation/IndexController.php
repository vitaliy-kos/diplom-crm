<?php

namespace App\Http\Controllers\Crm\MetroStation;

use App\Http\Controllers\Controller;
use App\Models\MetroStation;

class IndexController extends Controller
{
    public function __invoke()
    {
        $metroStations = MetroStation::all();
        return view('crm.metroStation.index', compact('metroStations'));
    }
}
