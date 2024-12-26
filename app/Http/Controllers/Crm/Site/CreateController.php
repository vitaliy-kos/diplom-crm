<?php

namespace App\Http\Controllers\Crm\Site;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view('crm.site.create');
    }
}
