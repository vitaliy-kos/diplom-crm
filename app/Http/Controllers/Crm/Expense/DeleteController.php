<?php

namespace App\Http\Controllers\Crm\Expense;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\Expense;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke(Expense $expense)
    {
        $expense->delete();

        CreateLog::add($expense, Route::currentRouteAction(), '');

        return redirect()->route('crm.expense.index');
    }
}
