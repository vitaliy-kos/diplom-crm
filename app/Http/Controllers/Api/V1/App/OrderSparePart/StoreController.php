<?php
namespace App\Http\Controllers\Api\V1\App\OrderSparePart;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\OrderSparePart;
use Illuminate\Support\Facades\Route;

class StoreController extends Controller
{
    public function __invoke($orderId)
    {
        $data = [];
        $data['order_id'] = $orderId;
        $data['created_at'] = date('Y-m-d H:i:s', time());
        
        $sparePart = OrderSparePart::firstOrCreate($data);
        
        CreateLog::add($sparePart, Route::currentRouteAction(), '');

        return response()->json(['status' => 200, 'data' => $sparePart]);
    }
}
