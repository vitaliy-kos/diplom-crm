<?php

namespace App\Http\Controllers\Crm\MetroStation;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view('crm.metroStation.create');
    }
}
