<?php

namespace App\Http\Controllers\Crm\Client;

use App\Http\Controllers\Controller;
use App\Models\City;

class CreateController extends Controller
{
    public function __invoke()
    {
       $cities = City::all();

        return view('crm.client.create', compact('cities'));
    }
}
