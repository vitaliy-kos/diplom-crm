<?php

namespace App\Http\Controllers\Crm\Phone;

use App\Http\Controllers\Controller;
use App\Models\Site;

class CreateController extends Controller
{
    public function __invoke()
    {
        $sites = Site::all();

        return view('crm.phone.create', compact(
            'sites'
        ));
    }
}
