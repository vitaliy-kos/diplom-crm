<?php

namespace App\Http\Controllers\Crm\Phone;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Phone\UpdateRequest;
use App\Models\Phone;
use Illuminate\Support\Facades\Route;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Phone $phone)
    {
        $data = $request->validated();
        $phone->update($data);

        CreateLog::add($phone, Route::currentRouteAction(), '');

        return redirect()->route('crm.phone.show', $phone->id);
    }
}
