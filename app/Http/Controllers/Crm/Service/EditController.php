<?php

namespace App\Http\Controllers\Crm\Service;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\Service;

class EditController extends Controller
{
    public function __invoke(Service $service)
    {
        $logs = GetLog::getAll($service);

        return view('crm.service.edit', compact('service', 'logs'));
    }
}
