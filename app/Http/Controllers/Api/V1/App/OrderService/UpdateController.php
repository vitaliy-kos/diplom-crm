<?php
namespace App\Http\Controllers\Api\V1\App\OrderService;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\OrderServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    public function __invoke(Request $request, $orderId, $serviceId)
    {
        $validator = Validator::make($request->all(), [
            "service_id" => 'nullable|integer',
            "comment" => 'nullable|string',
            "sum_pay" => 'nullable|integer',
            "minus_spare" => 'nullable|integer',
            "our_percent" => 'nullable|integer',
            "profit" => 'nullable',
            "paid_at" => 'nullable',
        ]);
        

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->all()], 400);
        }

        $service = OrderServices::where("order_id", '=', $orderId)
                                ->where("id", '=', $serviceId)
                                ->first();
        
        $service->update([
            "service_id" => $request->service_id,
            "comment" => $request->comment,
            "sum_pay" => $request->sum_pay,
            "minus_spare" => $request->minus_spare,
            "our_percent" => $request->our_percent,
            "profit" => $request->profit,
            "paid_at" => $request->paid_at ? date('Y-m-d H:i:s', time()) : null,
        ]);
                                

        CreateLog::add($service, Route::currentRouteAction(), '');

        return response()->json(['status' => 200, 'data' => $service]);

        
    }
}
