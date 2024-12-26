<?php

namespace App\Http\Controllers\Crm\TechnicsType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\Site;
use App\Models\TechnicsType;

class EditController extends Controller
{
    public function __invoke(TechnicsType $technicsType)
    {
        $logs = GetLog::getAll($technicsType);

        return view('crm.technicsType.edit', compact(
            'technicsType',
            'logs'
        ));
    }
}
