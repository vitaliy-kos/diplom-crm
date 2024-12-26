<?php

namespace App\Http\Controllers\Crm\Expense;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Expense\UpdateRequest;
use App\Models\Expense;
use Illuminate\Support\Facades\Route;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Expense $expense)
    {
        $data = $request->validated();

        $expense->update($data);

        CreateLog::add($expense, Route::currentRouteAction(), '');

        return redirect()->route('crm.expense.show', $expense);
    }
}
