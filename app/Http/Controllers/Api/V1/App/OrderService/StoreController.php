<?php
namespace App\Http\Controllers\Api\V1\App\OrderService;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\OrderServices;
use Illuminate\Support\Facades\Route;

class StoreController extends Controller
{
    public function __invoke($orderId)
    {
        $data = [];
        $data['order_id'] = $orderId;
        $data['created_at'] = date('Y-m-d H:i:s', time());
        
        $service = OrderServices::firstOrCreate($data);
        
        CreateLog::add($service, Route::currentRouteAction(), '');

        return response()->json(['status' => 200, 'data' => $service]);
    }
}
