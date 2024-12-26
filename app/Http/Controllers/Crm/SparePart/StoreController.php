<?php

namespace App\Http\Controllers\Crm\SparePart;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\SparePart\StoreRequest;
use App\Models\SparePart;
use Illuminate\Support\Facades\Route;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $sparePart = SparePart::firstOrCreate($data);

        CreateLog::add($sparePart, Route::currentRouteAction(), '');


        return redirect()->route('crm.sparePart.index');
    }
}
