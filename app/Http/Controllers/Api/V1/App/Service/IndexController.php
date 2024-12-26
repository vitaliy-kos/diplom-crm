<?php
namespace App\Http\Controllers\Api\V1\App\Service;

use App\Http\Controllers\Controller;
use App\Models\Service;

class IndexController extends Controller
{
    public function __invoke()
    {
        $services = Service::all();

        return response()->json(['status' => 200, 'data' => $services]);
    }


}
