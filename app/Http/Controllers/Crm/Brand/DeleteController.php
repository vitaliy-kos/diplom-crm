<?php

namespace App\Http\Controllers\Crm\Brand;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\Brand;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke(Brand $brand)
    {
        $brand->delete();

        CreateLog::add($brand, Route::currentRouteAction(), '');

        return redirect()->route('crm.brand.index');
    }
}
