<?php

namespace App\Http\Controllers\Crm\Status;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Status\StoreRequest;
use App\Models\Status;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
//        $data['icon'] = Storage::put('images/status-icon/', $data['icon']);
        $status = Status::firstOrCreate($data);

        CreateLog::add($status, Route::currentRouteAction(), '');

        return redirect()->route('crm.status.index');
    }
}
