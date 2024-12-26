<?php

namespace App\Http\Controllers\Crm\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\Service;
use App\Models\Site;

class EditController extends Controller
{
    public function __invoke(Site $site)
    {
        $logs = GetLog::getAll($site);

        return view('crm.site.edit', compact('site', 'logs'));
    }
}
