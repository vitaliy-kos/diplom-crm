<?php

namespace App\Http\Controllers\Crm\Phone;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\Phone;
use App\Models\Site;

class ShowController extends Controller
{
    public function __invoke(Phone $phone)
    {
        $sites = Site::all();
        $logs = GetLog::getAll($phone);

        return view('crm.phone.show', compact(
            'phone', 
            'sites',
            'logs'
        ));
    }
}
