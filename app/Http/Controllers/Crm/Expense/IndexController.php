<?php

namespace App\Http\Controllers\Crm\Expense;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseType;

class IndexController extends Controller
{
    public function __invoke()
    {
        $expenses = Expense::all();
        $expense_types = ExpenseType::all();

        return view('crm.expense.index', compact('expenses', 'expense_types' ));
    }
}
