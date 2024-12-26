<?php

namespace App\Http\Controllers\Crm\IncomeType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\IncomeType;

class EditController extends Controller
{
    public function __invoke(IncomeType $incomeType)
    {
        $logs = GetLog::getAll($incomeType);

        return view('crm.incomeType.edit', compact('incomeType', 'logs'));
    }
}
