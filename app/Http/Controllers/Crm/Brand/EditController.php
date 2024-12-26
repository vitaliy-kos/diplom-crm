<?php

namespace App\Http\Controllers\Crm\Brand;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\Brand;

class EditController extends Controller
{
    public function __invoke(Brand $brand)
    {
        $logs = GetLog::getAll($brand);

        return view('crm.brand.edit', compact(
            'brand', 
            'logs'
        ));
    }
}
