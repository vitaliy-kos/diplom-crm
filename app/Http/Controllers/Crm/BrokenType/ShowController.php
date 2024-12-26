<?php

namespace App\Http\Controllers\Crm\BrokenType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\BrokenType;
use App\Models\TechnicsType;

class ShowController extends Controller
{
    public function __invoke(BrokenType $brokenType)
    {
        $technics_types = TechnicsType::all();
        $logs = GetLog::getAll($brokenType);

        return view('crm.brokenType.show', compact(
            'brokenType',
            'technics_types',
            'logs'
        ));
    }
}
