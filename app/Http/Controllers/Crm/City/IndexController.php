<?php

namespace App\Http\Controllers\Crm\City;

use App\Http\Controllers\Controller;
use App\Models\City;

class IndexController extends Controller
{
    public function __invoke()
    {
        $cities = City::all();
        return view('crm.city.index', compact('cities'));
    }
}
