<?php

namespace App\Http\Controllers\Crm\Service;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view('crm.service.create');
    }
}
