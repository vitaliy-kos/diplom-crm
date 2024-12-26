<?php
namespace App\Http\Controllers\Api\V1\App\OrderService;

use App\Http\Controllers\Controller;
use App\Http\Requests\Crm\Client\IndexRequest;
use App\Models\City;
use App\Models\Client;
use App\Models\OrderServices;

class IndexController extends Controller
{
    public function __invoke($orderId)
    {
        $services = OrderServices::where('order_id', '=', $orderId)->get();

        return response()->json(['status' => 200, 'data' => $services]);
    }


}
