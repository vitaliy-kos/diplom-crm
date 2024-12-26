<?php

namespace App\Http\Controllers\Crm\IncomeType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\IncomeType\StoreRequest;
use App\Models\IncomeType;
use Illuminate\Support\Facades\Route;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $incomeType = IncomeType::firstOrCreate($data);

        CreateLog::add($incomeType, Route::currentRouteAction(), '');

        return redirect()->route('crm.incomeType.index');
    }
}
