<?php

namespace App\Http\Controllers\Crm\Site;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Site;

class IndexController extends Controller
{
    public function __invoke()
    {
        $sites = Site::all();
        return view('crm.site.index', compact('sites'));
    }
}
