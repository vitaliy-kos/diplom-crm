<?php

namespace App\Http\Controllers\Crm\City;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view('crm.city.create');
    }
}
