<?php

namespace App\Http\Controllers\Crm\Expense;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Expense\StoreRequest;
use App\Models\Expense;
use Illuminate\Support\Facades\Route;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $expense = Expense::firstOrCreate($data);

        CreateLog::add($expense, Route::currentRouteAction(), '');

        return redirect()->route('crm.expense.index');
    }
}
