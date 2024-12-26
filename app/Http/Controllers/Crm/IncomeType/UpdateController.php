<?php

namespace App\Http\Controllers\Crm\IncomeType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\IncomeType\UpdateRequest;
use App\Models\IncomeType;
use Illuminate\Support\Facades\Route;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, IncomeType $incomeType)
    {
        $data = $request->validated();
        $incomeType->update($data);

        CreateLog::add($incomeType, Route::currentRouteAction(), '');

        return view('crm.incomeType.show', compact('incomeType'));
    }
}
