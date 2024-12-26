<?php

namespace App\Http\Controllers\Crm\ExpenseType;

use App\Http\Controllers\Controller;
use App\Models\ExpenseType;

class IndexController extends Controller
{
    public function __invoke()
    {
        $expenseTypes = ExpenseType::all();
        return view('crm.expenseType.index', compact('expenseTypes'));
    }
}
