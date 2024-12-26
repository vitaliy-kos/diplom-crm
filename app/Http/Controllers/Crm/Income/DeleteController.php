<?php

namespace App\Http\Controllers\Crm\Income;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\Income;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke(Income $income)
    {
        $income->delete();

        CreateLog::add($income, Route::currentRouteAction(), '');

        return redirect()->route('crm.income.index');
    }
}
