<?php

namespace App\Http\Controllers\Crm\SparePart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Crm\BrokenType\IndexRequest;
use App\Models\SparePart;
use App\Models\TechnicsType;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {
        $technics_types = TechnicsType::all();

        $query = SparePart::orderBy('id', 'desc');
        
        if ($request->filled('technics_type')) {
            $query = $query->where('technic_type_id', '=', $request->get('technics_type'));
        }

        $spareParts = $query->get();

        return view('crm.sparePart.index', compact(
            'technics_types',
            'spareParts',
            'request'
        ));
    }
}
