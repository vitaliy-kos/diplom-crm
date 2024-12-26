<?php

namespace App\Http\Controllers\Crm\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\Site;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke(Site $site)
    {
        $site->delete();

        CreateLog::add($site, Route::currentRouteAction(), '');

        return redirect()->route('crm.site.index');
    }
}
