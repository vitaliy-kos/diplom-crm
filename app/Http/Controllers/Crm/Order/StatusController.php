<?php

namespace App\Http\Controllers\Crm\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Order\StatusRequest;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

class StatusController extends Controller
{
    public function __invoke(StatusRequest $request, Order $order, $statusId)
    {
        
        // $data = $request->validated();
        
        $order->update(['status_id' => $statusId]);

        CreateLog::add($order, Route::currentRouteAction(), '');

        return redirect()->route('crm.order.edit', $order->id);
    }
}
