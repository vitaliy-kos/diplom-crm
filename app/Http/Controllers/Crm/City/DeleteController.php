<?php

namespace App\Http\Controllers\Crm\City;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\City;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke(City $city)
    {
        $city->delete();

        CreateLog::add($city, Route::currentRouteAction(), '');

        return redirect()->route('crm.city.index');
    }
}
