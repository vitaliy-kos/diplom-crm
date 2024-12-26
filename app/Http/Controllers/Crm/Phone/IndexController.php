<?php

namespace App\Http\Controllers\Crm\Phone;

use App\Http\Controllers\Controller;
use App\Models\Phone;

class IndexController extends Controller
{
    public function __invoke()
    {
        $phones = Phone::all();
        return view('crm.phone.index', compact('phones'));
    }
}
