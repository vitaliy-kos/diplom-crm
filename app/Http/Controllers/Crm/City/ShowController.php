<?php

namespace App\Http\Controllers\Crm\City;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\City;
use Illuminate\Support\Facades\Auth;

class ShowController extends Controller
{
    public function __invoke(City $city)
    {
        $logs = GetLog::getAll($city);

        return view('crm.city.show', compact('city', 'logs'));
    }
}
