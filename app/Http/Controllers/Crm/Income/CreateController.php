<?php

namespace App\Http\Controllers\Crm\Income;

use App\Http\Controllers\Controller;
use App\Models\IncomeType;
use App\Models\Partner;

class CreateController extends Controller
{
    public function __invoke()
    {
        $income_types = IncomeType::all();

        return view('crm.income.create', compact('income_types'));
    }
}
