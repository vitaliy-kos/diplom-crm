<?php

namespace App\Http\Controllers\Crm\IncomeType;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view('crm.incomeType.create');
    }
}
