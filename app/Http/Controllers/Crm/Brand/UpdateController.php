<?php

namespace App\Http\Controllers\Crm\Brand;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Brand\UpdateRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Brand $brand)
    {
        $data = $request->validated();
        if (!empty($data['logo'])) {
            $data['logo'] = "/storage/" . Storage::put('images/brands-logo', $data['logo']);
        }
        $brand->update($data);

        CreateLog::add($brand, Route::currentRouteAction(), '');

        return redirect()->route('crm.brand.show', $brand);
    }
}
