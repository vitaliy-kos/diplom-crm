<?php

namespace App\Http\Controllers\Crm\IncomeType;

use App\Http\Controllers\Controller;
use App\Models\IncomeType;

class IndexController extends Controller
{
    public function __invoke()
    {
        $incomeTypes = IncomeType::all();
        return view('crm.incomeType.index', compact('incomeTypes'));
    }
}
