<?php

namespace App\Http\Controllers\Crm\Service;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Service;

class IndexController extends Controller
{
    public function __invoke()
    {
        $services = Service::all();
        return view('crm.service.index', compact('services'));
    }
}
