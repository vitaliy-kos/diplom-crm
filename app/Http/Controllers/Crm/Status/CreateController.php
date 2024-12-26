<?php

namespace App\Http\Controllers\Crm\Status;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view('crm.status.create');
    }
}
