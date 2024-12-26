<?php

namespace App\Http\Controllers\Crm\Phone;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\Phone;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke(Phone $phone)
    {
        $phone->delete();

        CreateLog::add($phone, Route::currentRouteAction(), '');

        return redirect()->route('crm.phone.index');
    }
}
