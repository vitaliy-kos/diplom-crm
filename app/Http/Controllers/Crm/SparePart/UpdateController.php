<?php

namespace App\Http\Controllers\Crm\SparePart;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\SparePart\UpdateRequest;
use App\Models\SparePart;
use Illuminate\Support\Facades\Route;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, SparePart $sparePart)
    {
        $data = $request->validated();
        $sparePart->update($data);

        CreateLog::add($sparePart, Route::currentRouteAction(), '');

        return redirect()->route('crm.sparePart.show', $sparePart->id);
    }
}
