<?php

namespace App\Http\Controllers\Crm\BrokenType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\BrokenType\UpdateRequest;
use App\Models\BrokenType;
use Illuminate\Support\Facades\Route;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, BrokenType $brokenType)
    {
        $data = $request->validated();
        $brokenType->update($data);

        CreateLog::add($brokenType, Route::currentRouteAction(), '');

        return redirect()->route('crm.brokenType.show', $brokenType->id);
    }
}
