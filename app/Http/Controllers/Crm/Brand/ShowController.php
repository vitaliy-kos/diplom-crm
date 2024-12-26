<?php

namespace App\Http\Controllers\Crm\Brand;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\Brand;

class ShowController extends Controller
{
    public function __invoke(Brand $brand)
    {
        $logs = GetLog::getAll($brand);

        return view('crm.brand.show', compact(
            'brand', 
            'logs'
        ));
    }
}
