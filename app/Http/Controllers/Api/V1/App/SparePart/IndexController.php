<?php
namespace App\Http\Controllers\Api\V1\App\SparePart;

use App\Http\Controllers\Controller;
use App\Models\SparePart;

class IndexController extends Controller
{
    public function __invoke()
    {
        $spareParts = SparePart::leftJoin(
                    'technics_types', 
                    'spare_parts.technic_type_id', 
                    '=', 
                    'technics_types.id')
                ->get([
                    'spare_parts.id', 
                    'spare_parts.name', 
                    'technics_types.name as category', 
                    'technics_types.id as category_id'
                ]);

        return response()->json(['status' => 200, 'data' => $spareParts]);
    }


}
