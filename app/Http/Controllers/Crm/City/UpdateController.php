<?php

namespace App\Http\Controllers\Crm\City;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\City\UpdateRequest;
use App\Models\City;
use Illuminate\Support\Facades\Route;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, City $city)
    {
        $data = $request->validated();
        $city->update($data);

        CreateLog::add($city, Route::currentRouteAction(), '');

        return view('crm.city.show', compact('city'));
    }
}
