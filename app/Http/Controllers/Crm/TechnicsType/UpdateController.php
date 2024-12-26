<?php

namespace App\Http\Controllers\Crm\TechnicsType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\TechnicsType\UpdateRequest;
use App\Models\TechnicsType;
use Illuminate\Support\Facades\Route;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, TechnicsType $technicsType)
    {
        $data = $request->validated();
        $technicsType->update($data);

        CreateLog::add($technicsType, Route::currentRouteAction(), '');

        return redirect()->route('crm.technicsType.show', $technicsType->id);
    }
}
