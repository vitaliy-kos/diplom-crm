<?php
namespace App\Http\Controllers\Api\V1\App\OrderService;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\OrderServices;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke($orderId, $serviceId)
    {
        $service = OrderServices::where('order_id', '=', $orderId)
                                ->where('id', '=', $serviceId)
                                ->firstOrFail();
        $service->delete();

        CreateLog::add($service, Route::currentRouteAction(), '');

        return response()->json(['status' => 204, 'data' => []]);
    }
}
