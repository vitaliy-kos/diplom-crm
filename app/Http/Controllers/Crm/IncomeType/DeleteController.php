<?php

namespace App\Http\Controllers\Crm\IncomeType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\IncomeType;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke(IncomeType $incomeType)
    {
        $incomeType->delete();

        CreateLog::add($incomeType, Route::currentRouteAction(), '');

        return redirect()->route('crm.incomeType.index');
    }
}
