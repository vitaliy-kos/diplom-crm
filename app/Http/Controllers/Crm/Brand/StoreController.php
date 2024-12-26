<?php

namespace App\Http\Controllers\Crm\Brand;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Brand\StoreRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $data['logo'] = "/storage/" . Storage::put('images/brands-logo', $data['logo']);
        $brand = Brand::firstOrCreate($data);

        CreateLog::add($brand, Route::currentRouteAction(), '');

        return redirect()->route('crm.brand.index');
    }
}
