<?php

namespace App\Http\Controllers\Crm\SparePart;

use App\Http\Controllers\Controller;
use App\Models\TechnicsType;

class CreateController extends Controller
{
    public function __invoke()
    {
        $technics_types = TechnicsType::all();
        
        return view('crm.sparePart.create', compact(
            'technics_types'
        ));
    }
}
