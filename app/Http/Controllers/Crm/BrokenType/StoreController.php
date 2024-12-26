<?php

namespace App\Http\Controllers\Crm\BrokenType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\BrokenType\StoreRequest;
use App\Models\BrokenType;
use Illuminate\Support\Facades\Route;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $brokenType = BrokenType::firstOrCreate($data);

        CreateLog::add($brokenType, Route::currentRouteAction(), '');


        return redirect()->route('crm.brokenType.index');
    }
}
