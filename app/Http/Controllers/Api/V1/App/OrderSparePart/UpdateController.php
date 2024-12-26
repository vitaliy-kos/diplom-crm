<?php
namespace App\Http\Controllers\Api\V1\App\OrderSparePart;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\OrderSparePart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    public function __invoke(Request $request, $orderId, $sparePartId)
    {
        $validator = Validator::make($request->all(), [
            "spare_part_id" => 'nullable|integer',
            "comment" => 'nullable|string',
            "price" => 'nullable|integer',
            "quantity" => 'nullable|integer',
            "result" => 'nullable',
        ]);
        

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->all()], 400);
        }

        $sparePart = OrderSparePart::where("order_id", '=', $orderId)
                                ->where("id", '=', $sparePartId)
                                ->first();
        
        $sparePart->update([
            "spare_part_id" => $request->spare_part_id,
            "comment" => $request->comment,
            "price" => $request->price,
            "quantity" => $request->quantity,
            "result" => $request->result,
        ]);
                                

        CreateLog::add($sparePart, Route::currentRouteAction(), '');

        return response()->json(['status' => 200, 'data' => $sparePart]);

        
    }
}
