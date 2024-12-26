<?php

namespace App\Http\Controllers\Crm\Income;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Income\StoreRequest;
use App\Models\Income;
use Illuminate\Support\Facades\Route;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $income = Income::firstOrCreate($data);

        CreateLog::add($income, Route::currentRouteAction(), '');

        return redirect()->route('crm.income.index');
    }
}
