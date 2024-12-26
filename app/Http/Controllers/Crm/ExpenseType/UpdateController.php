<?php

namespace App\Http\Controllers\Crm\ExpenseType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\ExpenseType\UpdateRequest;
use App\Models\ExpenseType;
use Illuminate\Support\Facades\Route;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, ExpenseType $expenseType)
    {
        $data = $request->validated();
        $expenseType->update($data);

        CreateLog::add($expenseType, Route::currentRouteAction(), '');

        return view('crm.expenseType.show', compact('expenseType'));
    }
}
