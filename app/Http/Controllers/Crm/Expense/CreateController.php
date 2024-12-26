<?php

namespace App\Http\Controllers\Crm\Expense;

use App\Http\Controllers\Controller;
use App\Models\ExpenseType;
use App\Models\Partner;

class CreateController extends Controller
{
    public function __invoke()
    {
        $expense_types = ExpenseType::all();

        return view('crm.expense.create', compact('expense_types'));
    }
}
