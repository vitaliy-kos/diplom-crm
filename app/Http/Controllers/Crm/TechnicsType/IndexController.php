<?php

namespace App\Http\Controllers\Crm\TechnicsType;

use App\Http\Controllers\Controller;
use App\Models\TechnicsType;

class IndexController extends Controller
{
    public function __invoke()
    {
        $technicsTypes = TechnicsType::all();
        return view('crm.technicsType.index', compact('technicsTypes'));
    }
}
