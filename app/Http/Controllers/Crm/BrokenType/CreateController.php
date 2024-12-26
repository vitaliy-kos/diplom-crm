<?php

namespace App\Http\Controllers\Crm\BrokenType;

use App\Http\Controllers\Controller;
use App\Models\TechnicsType;

class CreateController extends Controller
{
    public function __invoke()
    {
        $technics_types = TechnicsType::all();
        
        return view('crm.brokenType.create', compact(
            'technics_types'
        ));
    }
}
