<?php

namespace App\Http\Controllers\Crm\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Site\StoreRequest;
use App\Models\Site;
use Illuminate\Support\Facades\Route;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $site = Site::firstOrCreate($data);

        CreateLog::add($site, Route::currentRouteAction(), '');


        return redirect()->route('crm.site.index');
    }
}
