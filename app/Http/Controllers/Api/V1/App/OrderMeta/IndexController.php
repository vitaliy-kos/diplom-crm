<?php
namespace App\Http\Controllers\Api\V1\App\OrderMeta;

use App\Http\Controllers\Controller;
use App\Models\OrderMeta;

class IndexController extends Controller
{
    public function __invoke($orderId)
    {
        $orderMeta = OrderMeta::where('order_id', '=', $orderId)->get();

        return response()->json(['status' => 200, 'data' => $orderMeta]);
    }


}
