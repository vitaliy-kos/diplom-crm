<?php

namespace App\Http\Controllers\Crm\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\City;
use App\Models\Client;
use App\Models\MetroStation;

class EditController extends Controller
{
    public function __invoke(Client $client)
    {
        $cities = City::all();
        $metroStations = MetroStation::all();
        $logs = GetLog::getAll($client);
        
        return view('crm.client.edit', compact(
            'client', 
            'cities',
            'metroStations',
            'logs'));
    }
}
