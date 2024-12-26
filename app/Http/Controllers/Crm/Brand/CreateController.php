<?php

namespace App\Http\Controllers\Crm\Brand;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view('crm.brand.create');
    }
}
