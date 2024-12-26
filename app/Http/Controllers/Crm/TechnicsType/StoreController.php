<?php

namespace App\Http\Controllers\Crm\TechnicsType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\TechnicsType\StoreRequest;
use App\Models\TechnicsType;
use Illuminate\Support\Facades\Route;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $technicsType = TechnicsType::firstOrCreate($data);

        CreateLog::add($technicsType, Route::currentRouteAction(), '');


        return redirect()->route('crm.technicsType.index');
    }
}
