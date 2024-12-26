<?php

namespace App\Http\Controllers\Crm\SparePart;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\SparePart;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke(SparePart $sparePart)
    {
        $sparePart->delete();

        CreateLog::add($sparePart, Route::currentRouteAction(), '');

        return redirect()->route('crm.sparePart.index');
    }
}
