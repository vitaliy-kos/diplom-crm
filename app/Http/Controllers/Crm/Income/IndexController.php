<?php

namespace App\Http\Controllers\Crm\Income;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\IncomeType;

class IndexController extends Controller
{
    public function __invoke()
    {
        $incomes = Income::all();
        $income_types = IncomeType::all();

        return view('crm.income.index', compact('incomes', 'income_types' ));
    }
}
