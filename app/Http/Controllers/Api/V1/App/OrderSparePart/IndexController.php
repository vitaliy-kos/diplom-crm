<?php
namespace App\Http\Controllers\Api\V1\App\OrderSparePart;

use App\Http\Controllers\Controller;
use App\Models\OrderSparePart;

class IndexController extends Controller
{
    public function __invoke($orderId)
    {
        $spareParts = OrderSparePart::where('order_id', '=', $orderId)->get();

        return response()->json(['status' => 200, 'data' => $spareParts]);
    }


}
