<?php

namespace App\Http\Controllers\Crm\City;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\City\StoreRequest;
use App\Models\City;
use Illuminate\Support\Facades\Route;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $city = City::firstOrCreate($data);

        CreateLog::add($city, Route::currentRouteAction(), '');

        return redirect()->route('crm.city.index');
    }
}
