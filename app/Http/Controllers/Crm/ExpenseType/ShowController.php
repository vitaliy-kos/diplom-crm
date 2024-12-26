<?php

namespace App\Http\Controllers\Crm\ExpenseType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\ExpenseType;

class ShowController extends Controller
{
    public function __invoke(ExpenseType $expenseType)
    {
        $logs = GetLog::getAll($expenseType);

        return view('crm.expenseType.show', compact('expenseType', 'logs'));
    }
}
