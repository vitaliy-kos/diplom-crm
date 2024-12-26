<?php
namespace App\Http\Controllers\Api\V1\App\OrderMeta;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\OrderMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    public function __invoke(Request $request, $orderId, $metaKey)
    {
        $validator = Validator::make($request->all(), [
            "value" => 'nullable|string',
        ]);
        

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->all()], 400);
        }
        $orderMeta = OrderMeta::firstOrCreate(
            [
                'order_id' => $orderId, 
                'key' => $metaKey
            ]
        );
        
        $orderMeta->update([
            "value" => $request->value,
        ]);    

        CreateLog::add($orderMeta, Route::currentRouteAction(), '');

        return response()->json(['status' => 200, 'data' => $orderMeta]);

        
    }
}
