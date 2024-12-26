<?php
namespace App\Http\Controllers\Api\V1\App\OrderMeta;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\OrderMeta;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke($orderId, $metaKey)
    {
        $orderMeta = OrderMeta::where('order_id', '=', $orderId)
                              ->where('key', '=', $metaKey)
                              ->firstOrFail();
        $orderMeta->delete();

        CreateLog::add($orderMeta, Route::currentRouteAction(), '');

        return response()->json(['status' => 204, 'data' => []]);
    }
}
