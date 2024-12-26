<?php

namespace App\Http\Controllers\Crm\Phone;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Phone\StoreRequest;
use App\Models\Phone;
use Illuminate\Support\Facades\Route;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $phone = Phone::firstOrCreate($data);

        CreateLog::add($phone, Route::currentRouteAction(), '');


        return redirect()->route('crm.phone.index');
    }
}
