<?php

namespace App\Http\Controllers\Crm\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;

class IndexController extends Controller
{
    public function __invoke()
    {
        $brands = Brand::all();
        return view('crm.brand.index', compact('brands'));
    }
}
