<?php
namespace App\Http\Controllers\Api\V1\App\OrderSparePart;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\OrderSparePart;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke($orderId, $sparePartId)
    {
        $sparePart = OrderSparePart::where('order_id', '=', $orderId)
                                ->where('id', '=', $sparePartId)
                                ->firstOrFail();
        $sparePart->delete();

        CreateLog::add($sparePart, Route::currentRouteAction(), '');

        return response()->json(['status' => 204, 'data' => []]);
    }
}
