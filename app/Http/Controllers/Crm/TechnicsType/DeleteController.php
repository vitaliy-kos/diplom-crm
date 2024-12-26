<?php

namespace App\Http\Controllers\Crm\TechnicsType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\TechnicsType;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke(TechnicsType $technicsType)
    {
        $technicsType->delete();

        CreateLog::add($technicsType, Route::currentRouteAction(), '');

        return redirect()->route('crm.technicsType.index');
    }
}
