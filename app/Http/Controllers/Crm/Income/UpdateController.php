<?php

namespace App\Http\Controllers\Crm\Income;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Income\UpdateRequest;
use App\Models\Income;
use Illuminate\Support\Facades\Route;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Income $income)
    {
        $data = $request->validated();

        $income->update($data);

        CreateLog::add($income, Route::currentRouteAction(), '');

        return redirect()->route('crm.income.show', $income);
    }
}
