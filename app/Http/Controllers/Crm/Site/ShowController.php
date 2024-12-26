<?php

namespace App\Http\Controllers\Crm\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\Site;

class ShowController extends Controller
{
    public function __invoke(Site $site)
    {
        $logs = GetLog::getAll($site);

        return view('crm.site.show', compact('site', 'logs'));
    }
}
