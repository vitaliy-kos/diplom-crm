<?php

namespace App\Http\Controllers\Crm\ExpenseType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\ExpenseType\StoreRequest;
use App\Models\ExpenseType;
use Illuminate\Support\Facades\Route;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $expenseType = ExpenseType::firstOrCreate($data);

        CreateLog::add($expenseType, Route::currentRouteAction(), '');

        return redirect()->route('crm.expenseType.index');
    }
}
