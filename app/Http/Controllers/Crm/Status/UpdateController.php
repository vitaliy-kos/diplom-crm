<?php

namespace App\Http\Controllers\Crm\Status;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Status\UpdateRequest;
use App\Models\Status;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Status $status)
    {
        $data = $request->validated();
//        if (!empty($data['icon'])) {
//            $data['icon'] = Storage::put('images/status-icon/', $data['icon']);
//        }
        $status->update($data);

        CreateLog::add($status, Route::currentRouteAction(), '');

        return redirect()->route('crm.status.show', $status);

        //view('crm.status.show', compact('status'));
    }
}
