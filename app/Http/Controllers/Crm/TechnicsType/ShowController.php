<?php

namespace App\Http\Controllers\Crm\TechnicsType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\TechnicsType;

class ShowController extends Controller
{
    public function __invoke(TechnicsType $technicsType)
    {
        $logs = GetLog::getAll($technicsType);

        return view('crm.technicsType.show', compact(
            'technicsType',
            'logs'
        ));
    }
}
