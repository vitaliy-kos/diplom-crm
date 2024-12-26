<?php

namespace App\Http\Controllers\Crm\SparePart;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\SparePart;
use App\Models\TechnicsType;

class ShowController extends Controller
{
    public function __invoke(SparePart $sparePart)
    {
        $technics_types = TechnicsType::all();
        $logs = GetLog::getAll($sparePart);

        return view('crm.sparePart.show', compact(
            'sparePart',
            'technics_types',
            'logs'
        ));
    }
}
