<?php

namespace App\Http\Controllers\Crm\Expense;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\Expense;
use App\Models\ExpenseType;
use App\Models\Partner;

class EditController extends Controller
{
    public function __invoke(Expense $expense)
    {
        $expense_types = ExpenseType::all();
        
        $logs = GetLog::getAll($expense);
        return view('crm.expense.edit', compact('expense',  'expense_types', 'logs'));
    }
}
