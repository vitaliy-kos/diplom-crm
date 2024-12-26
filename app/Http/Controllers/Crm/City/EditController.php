<?php

namespace App\Http\Controllers\Crm\City;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\City;

class EditController extends Controller
{
    public function __invoke(City $city)
    {
        $logs = GetLog::getAll($city);

        return view('crm.city.edit', compact('city', 'logs'));
    }
}
