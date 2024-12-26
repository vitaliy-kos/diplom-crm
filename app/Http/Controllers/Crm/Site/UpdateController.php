<?php

namespace App\Http\Controllers\Crm\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Site\UpdateRequest;
use App\Models\Site;
use Illuminate\Support\Facades\Route;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Site $site)
    {
        $data = $request->validated();
        $site->update($data);

        CreateLog::add($site, Route::currentRouteAction(), '');

        return redirect()->route('crm.site.show', $site->id);
    }
}
