<?php

namespace App\Http\Controllers\Crm\IncomeType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\IncomeType;

class ShowController extends Controller
{
    public function __invoke(IncomeType $incomeType)
    {
        $logs = GetLog::getAll($incomeType);

        return view('crm.incomeType.show', compact('incomeType', 'logs'));
    }
}
