<?php

namespace App\Http\Controllers\Crm\ExpenseType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\ExpenseType;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke(ExpenseType $expenseType)
    {
        $expenseType->delete();

        CreateLog::add($expenseType, Route::currentRouteAction(), '');

        return redirect()->route('crm.expenseType.index');
    }
}
