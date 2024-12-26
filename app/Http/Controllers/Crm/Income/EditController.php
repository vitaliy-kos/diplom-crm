<?php

namespace App\Http\Controllers\Crm\Income;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\Income;
use App\Models\IncomeType;
use App\Models\Partner;

class EditController extends Controller
{
    public function __invoke(Income $income)
    {
        $income_types = IncomeType::all();
        
        $logs = GetLog::getAll($income);
        return view('crm.income.edit', compact('income',  'income_types', 'logs'));
    }
}
