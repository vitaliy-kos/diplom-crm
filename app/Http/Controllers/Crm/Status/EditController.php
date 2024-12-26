<?php

namespace App\Http\Controllers\Crm\Status;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\Status;

class EditController extends Controller
{
    public function __invoke(Status $status)
    {
        $logs = GetLog::getAll($status);

        return view('crm.status.edit', compact('status', 'logs'));
    }
}
