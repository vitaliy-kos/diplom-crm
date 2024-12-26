<?php

namespace App\Http\Controllers\Crm\BrokenType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\BrokenType;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke(BrokenType $brokenType)
    {
        $brokenType->delete();

        CreateLog::add($brokenType, Route::currentRouteAction(), '');

        return redirect()->route('crm.brokenType.index');
    }
}
