<?php

namespace App\Http\Controllers\Crm\BrokenType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Crm\BrokenType\IndexRequest;
use App\Models\BrokenType;
use App\Models\TechnicsType;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {
        $technics_types = TechnicsType::all();

        $query = BrokenType::orderBy('id', 'desc');
        
        if ($request->filled('technics_type')) {
            $query = $query->where('technic_type_id', '=', $request->get('technics_type'));
        }

        $brokenTypes = $query->get();

        return view('crm.brokenType.index', compact(
            'technics_types',
            'brokenTypes',
            'request'
        ));
    }
}
